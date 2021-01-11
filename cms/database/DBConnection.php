<?php

// Connexion à la base de données

namespace Database;

use PDO;

class DBConnection {
    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPDO(): PDO //Renvoie le PDO
    {
        return $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->username, $this->password ?? $this->pdo, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8' //Afficher les caractères spéciaux
        ]);

    }
}