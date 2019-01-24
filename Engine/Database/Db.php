<?php declare(strict_types=1);
/**
 * @author rimom.costa <rimomcosta@gmail.com>
 * Date: 2019-01-24
 * @version 1.0
 */

namespace Engine\Database;

class Db
{
    /**
     * @param array $config
     * @return \PDO
     */
    public static function connect(array $config): \PDO
    {
        try {
            return new \PDO(
                $config['dsn'],
                $config['username'],
                $config['password'],
                $config['options']
            );

        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}