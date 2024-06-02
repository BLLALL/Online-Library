<?php

// namespace Core;

// use PDO;
class Database
{
    private $connection, $statement;

    private   $config =   [
        'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname'  => 'bookstore',
        'charset' => 'utf8mb4'
        ]
    ];
    

    public function __construct($username = 'root', $password = '') {
        $dns = 'mysql:' . http_build_query($this->config, '', ';');

        $this->connection = new PDO($dns, $username, $password, 
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        
        return $this;
    }

    public function find() {
        return $this->statement->fetch();
    }
    public function get() {
        return $this->statement->fetchAll();
    }
    public function findOrFail() {
        $result = $this -> find();
        // if(!$result) abort();
        return $result;
    }


    public function getOrFail() {
        $result = $this -> get();
        // if(!$result) abort();
        return $result;
    }
}
