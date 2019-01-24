<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace App\Controllers;

use App\Models\EmployeeRepository;
use Engine\Response;

class PagesController
{
    /**
     * @param Response $response
     * @return mixed
     * @throws \Exception
     */
    public function index(Response $response)
    {
        $collection = new EmployeeRepository();
        $employees = $collection->getAll();

        return $response->render('index', ['employees' => $employees]);
    }

    /**
     * @param Response $response
     * @return mixed
     */
    public function notFound(Response $response)
    {

        return $response->render('notFound');
    }

    public function test($args)
    {
        echo '<pre>It is just a test to get arguments from the URL: ';
        print_r($args);
    }

}