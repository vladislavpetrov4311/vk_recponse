<?php

class connectPDO
{
    private string $host = 'my_bd';
    private string $username = 'root';
    private string $password = 'root';
    private string $database = 'testDB';

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database;", $this->username, $this->password);
    }

    public function get_obj(): PDO
    {
        return $this->pdo;
    }
}

?>