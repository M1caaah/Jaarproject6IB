<?php

namespace app\core;

class Database
{
    public \MySQLi $mysqli;

    public function __construct(array $config)
    {

        $this->mysqli = new \MySQLi(
            $config['db']['host'] ?? '',
            $config['db']['user'] ?? '',
            $config['db']['password'] ?? '',
            $config['db']['dbname'] ?? '',
            $config['db']['port'] ?? 3306,
        );
        $query = "SELECT * FROM `tblclients` LIMIT 1";
        if (!$this->mysqli->query($query)) {

            // Read the SQL file content
            $sqlContent = file_get_contents("/bytebazaar.sql");

            // Execute the SQL statements from the file
            $this->mysqli->multi_query($sqlContent);
        }
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