<?php
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace App\Controllers;

use App\Models\Entities\Employee;
use App\Models\EmployeeRepository;
use Engine\Request;
use Engine\Response;

class OperationsController
{
    /**
     * @param Request $request
     * @param Response $response
     */
    public function save(Request $request, Response $response): void
    {
        $employee = (new Employee())
            ->setName($request->getParam('name'))
            ->setAge($request->getParam('age'))
            ->setJobTile($request->getParam('job_title'));

        (new EmployeeRepository())->save($employee);

        $response->redirect('/');
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public  function remove(Request $request, Response $response): void
    {
        $id = $request->getParam('id');

        (new EmployeeRepository())->remove($id);

        $response->redirect('/');
    }
}