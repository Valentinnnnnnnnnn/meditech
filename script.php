<?php

class Database
{
    public $host;
    public $db;
    public $user;
    public $pass;
    public $charset;
    public $pdo;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->charset = getenv('DB_CHARSET');

        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getAllMedicaments()
    {
        $sql = "SELECT id, reference, img, creation, prix, derniere_modification, quantite FROM medicaments;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}

