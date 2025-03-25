<?php

class database
{

    public $host = 'localhost';
    public $username = "root";
    public $password = 'Madhav@123';
    public $dbname = "dashboard";
    public $isConnect;

    public function __construct()
    {
        $connection = new mysqli($this->host, $this->username, $this->password);
        $crateDB = " CREATE DATABASE IF NOT EXISTS dashboard ";

        // if ($connection->query($crateDB) == "TRUE") {
        //     echo "<script> console.log('Database created sucessfully!!') </script>";
        // } else {
        //     echo $connection->error . "<script> console.log('*ERROR: Database was not created ') </script>";
        // }
    }

    public function dbConnection()
    {
        return $this->isConnect = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }
}

$dbConnectionObj = new database();
