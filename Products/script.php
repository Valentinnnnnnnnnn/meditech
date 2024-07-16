<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}

class Database
{
    public $host = '127.0.0.1';
    public $db = 'meditech';
    public $user = 'user';
    public $pass = 'Azerty1234';
    public $charset = 'utf8mb4';
    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            phpinfo();
            var_dump($e->getMessage());
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

