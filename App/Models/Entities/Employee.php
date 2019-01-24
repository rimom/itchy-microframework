<?php
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace App\Models\Entities;

class Employee
{
    private $name;
    private $age;
    private $job_tile;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Employee
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return Employee
     */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string
     */
    public function getJobTile(): string
    {
        return $this->job_tile;
    }

    /**
     * @param string $job_tile
     * @return Employee
     */
    public function setJobTile(string $job_tile): self
    {
        $this->job_tile = $job_tile;

        return $this;
    }


}