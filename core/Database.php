<?php

namespace app\core;

class Database
{
    public \MySQLi $mysqli;

    public function __construct(array $config)
    {

        $this->mysqli = new \MySQLi(
            $config['db']['host'],
            $config['db']['user'],
            $config['db']['password'],
            $config['db']['dbname'],
        );

        if ($this->mysqli->connect_error) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            exit();
        }
    }

    public function prepare($sql)
    {
        return $this->mysqli->prepare($sql);
    }
}