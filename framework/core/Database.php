<?php

namespace app\core;

class Database
{
    public \MySQLi $mysqli;

    public function __construct(array $config)
    {

        $this->mysqli = new \MySQLi(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['dbname'],
        );

        if ($this->mysqli->connect_error) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            exit();
        }
    }
}