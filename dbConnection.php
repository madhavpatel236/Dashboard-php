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
    }

    public function dbConnection()
    {
        return $this->isConnect = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }
}

$dbConnectionObj = new database();
