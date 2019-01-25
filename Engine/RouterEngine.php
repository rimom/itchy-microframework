<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine;

class RouterEngine
{
    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const DELETE = 'DELETE';
    private const NOT_FOUND_PAGE = 'notFound';
    private const CONTROLLER_OR_ACTION_NOT_DEFINED = 'Controller or Action not defined';

    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];
    private $request;
    private $response;
    private $args = [];
    private $namespace;
    private $namespacedRouter = [];

    /**
     * RouterEngine constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $route_file
     * @throws \Exception
     */
    public function init(string $route_file): void
    {
        require $route_file;
        $this->direct();
    }

    /**
     * @param string $uri
     * @param string $controller
     */
    public function get(string $uri, string $controller): void
    {
        $this->routes[self::GET][$uri] = $controller;
    }

    /**
     * @param string $uri
     * @param string $controller
     */
    public function post(string $uri, string $controller): void
    {
        $this->routes[self::POST][$uri] = $controller;
    }

    /**
     * @param string $uri
     * @param string $controller
     */
    public function put(string $uri, string $controller): void
    {
        $this->routes[self::PUT][$uri] = $controller;
    }

    /**
     * @param string $uri
     * @param string $controller
     */
    public function delete(string $uri, string $controller): void
    {
        $this->routes[self::DELETE][$uri] = $controller;
    }

    /**
     * @param string $namespace
     * @param callable $closure
     */
    protected function group(string $namespace, callable $closure): void
    {
        $router = new RouterEngine($this->request, $this->response);
        $router->setNamespace($namespace);
        $closure($router);
        $this->namespacedRouter[$namespace] = $router;
    }

    /**
     * @param string $namespace
     */
    protected function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @param string $method
     * @param string $path
     * @return string
     */
    protected function match(string $method, string $path): bool
    {
        return isset($this->routes[$method][$path]);
    }

    /**
     * @return string|void
     * @throws \Exception
     */
    protected function direct()
    {
        $uri = $this->request->getUri();
        $requestMethod = $this->request->method();

        $this->extractArguments($uri);

        foreach ($this->namespacedRouter as $router) {
            if ($router->match($requestMethod, $uri[0])) {
                $router->direct();
                return;
            }
        }

        if (array_key_exists($uri[0], $this->routes[$requestMethod])) {
            return $this->requestAction(
                ...explode('::', $this->routes[$requestMethod][$uri[0]])
            );
        }

        $this->response->redirect(self::NOT_FOUND_PAGE);
    }

    /**
     * @param array $uri
     */
    protected function extractArguments(array $uri): void
    {
        if (count($uri) > 1) {
            array_shift($uri);
        }
        foreach ($uri as $value) {
            $this->args[] = $value;
        }
    }

    /**
     * @param string $controller
     * @param string $action
     * @return string
     * @throws \ReflectionException
     */
    protected function requestAction(string $controller, string $action)
    {
        list($argsToInject, $controller) = $this->injectArgs($controller, $action);

        if (method_exists($controller, $action)) {
            return $controller->$action(...$argsToInject);
        }

        throw new \Exception(self::CONTROLLER_OR_ACTION_NOT_DEFINED);
    }

    /**
     * inject Request, Response and Parameters in the controller methods
     * @param string $controller
     * @param string $action
     * @return array
     * @throws \ReflectionException
     */
    protected function injectArgs(string $controller, string $action): array
    {
        $controllerClass = new \ReflectionClass($this->namespace . '\\' . $controller);
        $argsToInject = [];
        
        $parameters = $controllerClass->getMethod($action)->getParameters();

        foreach ($parameters as $parameterObject) {
            if ($parameterObject->getClass() && $parameterObject->getClass()->getName() === Request::class) {
                $argsToInject[] = $this->request;
            }
            if ($parameterObject->getClass() && $parameterObject->getClass()->getName() === Response::class) {
                $argsToInject[] = $this->response;
            }
        };

        $argsToInject[] = $this->args;
        $controller = $controllerClass->newInstanceArgs();

        return array($argsToInject, $controller);
    }

}

