<?php
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
     * @return string
     */
    public function index(Response $response): string
    {
        $collection = new EmployeeRepository();
        $employees = $collection->getAll();

        return $response->render('index', ['employees' => $employees]);
    }

    /**
     * @param Response $response
     * @return string
     */
    public function notFound(Response $response): string
    {

        return $response->render('notFound');
    }

}