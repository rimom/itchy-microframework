<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine;

class Response
{
    /**
     * @param string $viewName
     * @param array $data
     * @return mixed
     */
    function render(string $viewName, array $data = [])
    {
        extract($data);
        return require __DIR__ . "/../App/Views/{$viewName}.view.php";
    }

    /**
     * @param string $path
     */
    function redirect(string $path): void
    {

        header("Location: {$path}");
    }

}