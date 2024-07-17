<?php
session_start();

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

    public function getLastEvents($amount)
    {
        $sql = "SELECT date, auteur, action, target FROM events ORDER BY date DESC LIMIT :amount;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':amount' => $amount]);
        return $stmt->fetchAll();
    }

    public function createProduct($reference, $img, $prix, $quantite, $description, $fabricant, $type)
    {
        $sql = "INSERT INTO medicaments (reference, img, prix, quantite, description, fabricant, type, derniere_modification, creation)
            VALUES (:reference, :img, :prix, :quantite, :description, :fabricant, :type, NOW(), NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'reference' => $reference,
            'img' => $img,
            'prix' => $prix,
            'quantite' => $quantite,
            'description' => $description,
            'fabricant' => $fabricant,
            'type' => $type
        ]);

        $this->addEvent($_SESSION['email'], 'create', $reference);
    }

    public function addEvent($auteur, $action, $target)
    {
        $sql = "INSERT INTO events (date, auteur, action, target) VALUES (NOW(), :auteur, :action, :target);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'auteur' => $auteur,
            'action' => $action,
            'target' => $target,
        ]);
    }

    public function deleteProduct($productId)
    {
        $this->addEvent($_SESSION['email'], 'connected', '');
        $sql = "SELECT reference FROM medicaments WHERE id = :productId";
        $stmt = $this->pdo->prepare($sql);
        $this->addEvent($_SESSION['email'], 'connected', '');
        $stmt->execute([
            'productId' => $productId,
        ]);

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $reference = $product['reference'];
        $this->addEvent($_SESSION['email'], 'connected', '');

        $sql = "DELETE FROM medicaments WHERE id = :productId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'productID' => $productId,
        ]);

        $this->addEvent($_SESSION['email'], 'delete', $reference);
    }

    public function editProduct($productId, $reference, $img, $prix, $quantite, $description, $fabricant, $type)
    {
        $sql = "UPDATE medicaments
            SET reference = :reference,
                img = :img,
                prix = :prix,
                quantite = :quantite,
                description = :description,
                fabricant = :fabricant,
                type = :type,
                derniere_modification = NOW()
            WHERE id = :productId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'reference' => $reference,
            'img' => $img,
            'prix' => $prix,
            'quantite' => $quantite,
            'description' => $description,
            'fabricant' => $fabricant,
            'type' => $type,
            'productId' => $productId
        ]);

        $this->addEvent($_SESSION['email'], 'edit', $reference);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM utilisateurs WHERE identifiant = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Authentification réussie
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $password;

            $this->addEvent($_SESSION['email'], 'connected', '');
            return true;
        }

    }

    public function logout() {
        $this->addEvent($_SESSION['email'], 'disconnected', '');
        session_unset ();
        session_destroy ();
    }

    public function createAccount($identifiant, $hashed_password) {
        $sql = "SELECT * FROM utilisateurs WHERE identifiant = :identifiant";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'identifiant' => $identifiant
        ]);
        if ($stmt->fetch()) {
            return false;
        }

        $sql = "INSERT INTO utilisateurs (identifiant, mot_de_passe) VALUES (:identifiant, :mot_de_passe)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'identifiant' => $identifiant,
            'mot_de_passe' => $hashed_password
        ]);
        $this->addEvent($_SESSION['email'], 'createAccount', $identifiant);
    }

}

