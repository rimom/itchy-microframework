<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace App\Models;

use Engine\Container;
use App\Models\Entities\Employee;

class EmployeeRepository
{
    /**
     * @return array
     * @throws \Exception
     */
    public function getAll(): array
    {
        return Container::get('Database')->selectAll('exads_test');
    }

    /**
     * @param Employee $employee
     * @return EmployeeRepository
     * @throws \Exception
     */
    public function save(Employee $employee): self
    {
        $employeeToSave = [
            'name' => $employee->getName(),
            'age' => $employee->getAge(),
            'job_title' => $employee->getJobTile(),
        ];

        Container::get('Database')->insert('exads_test', $employeeToSave);

        return $this;
    }

    /**
     * @param int $id
     * @return EmployeeRepository
     * @throws \Exception
     */
    public function remove(string $id): self
    {
        Container::get('Database')->remove('exads_test', $id);

        return $this;
    }

}