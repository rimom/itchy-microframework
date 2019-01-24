<?php

return [
    'database' => [
        'dsn' => 'mysql:dbname=myDb;host=mariadb;post=3306',
        'username' => 'root',
        'password' => '123456',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];