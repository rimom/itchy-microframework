<?php
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine;

class Request
{
    private const REQUEST_URI = 'REQUEST_URI';
    private const REQUEST_METHOD = 'REQUEST_METHOD';

    /**
     * @return array
     */
    public function getUri(): array
    {
        $uri = trim(
            parse_url(
                $_SERVER[self::REQUEST_URI],
                PHP_URL_PATH),
            '/'
        );

        return explode('/', $uri);
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $_SERVER[self::REQUEST_METHOD];
    }

    /**
     * @param string $param
     * @return string
     */
    public function getParam(string $param): string
    {
        $paramRequested = $_POST[$param];
        return Validations::sanitize($paramRequested);
    }

}