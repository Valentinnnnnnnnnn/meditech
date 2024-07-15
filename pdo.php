<?php
$host = '127.0.0.1';
$db   = 'meditech';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sql = "SELECT * FROM medicaments";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll();
foreach ($user as $row) {
    foreach ($row as $key) {
        echo $key . " ";
    }
    echo '<br>';
}
?>





