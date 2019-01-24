<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine\Database;

class Queries
{
    private $pdo;

    /**
     * Queries constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $table
     * @return array
     */
    public function selectAll(string $table): array
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    /**
     * @param string $table
     * @param array $data
     * @return $this|string
     */
    public function insert(string $table, array $data)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(',', array_keys($data)),
            ':' . implode(', :', array_keys($data))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
        } catch (\PDOException $e) {

            return $e->getMessage();

        }

        return $this;
    }

    /**
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function remove(string $table, string $id): bool
    {
        $sql = "DELETE FROM $table WHERE id = :id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }
}