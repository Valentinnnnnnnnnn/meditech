<?php
session_start();

class Database
{
    public $host;  // Adresse du serveur de la base de données
    public $db;    // Nom de la base de données
    public $user;  // Nom d'utilisateur pour se connecter à la base de données
    public $pass;  // Mot de passe pour se connecter à la base de données
    public $charset; // charset utilisé pour la connexion

    public $pdo;   // Objet PDO pour la connexion à la base de données

    public function __construct()
    {
        // Récupération des informations de connexion depuis les variables d'environnement
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->charset = getenv('DB_CHARSET');

        // Construction du DSN pour PDO
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        // Options de configuration pour PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions en cas d'erreur
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Récupération des résultats sous forme de tableau associatif par défaut
            PDO::ATTR_EMULATE_PREPARES => false, // Désactiver l'émulation des requêtes préparées pour éviter les injections SQL
        ];

        try {
            // Tentative de connexion à la base de données avec PDO
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            // En cas d'échec de connexion, lever une exception PDOException
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getAllMedicaments()
    {
        $sql = "SELECT id, reference, img, creation, prix, derniere_modification, quantite FROM medicaments;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); // Retourne tous les résultats sous forme de tableau
    }

    public function getLastEvents($amount)
    {
        // Sélectionne les derniers événements, triés par date, en limitant le nombre par :amount
        $sql = "SELECT date, auteur, action, target FROM events ORDER BY date DESC LIMIT :amount;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':amount' => $amount]);
        return $stmt->fetchAll(); // Retourne tous les résultats sous forme de tableau
    }

    public function createProduct($reference, $img, $prix, $quantite, $description, $fabricant, $type)
    {
        // Insère un nouveau produit dans la table 'medicaments'
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

        // Ajoute un événement pour enregistrer la création du produit
        $this->addEvent($_SESSION['email'], 'create', $reference);
    }

    public function addEvent($auteur, $action, $target)
    {
        // Ajoute un nouvel événement dans la table 'events'
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
        // Sélectionne la référence du produit à supprimer
        $sql = "SELECT reference FROM medicaments WHERE id = :productId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'productId' => $productId,
        ]);

        // Récupère la référence du produit
        $product = $stmt->fetch();
        $reference = $product['reference'];

        // Supprime le produit de la table 'medicaments'
        $sql = "DELETE FROM medicaments WHERE id = :productId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'productId' => $productId,
        ]);

        // Ajoute un événement pour enregistrer la suppression du produit
        $this->addEvent($_SESSION['email'], 'delete', $reference);
    }

    public function editProduct($productId, $reference, $img, $prix, $quantite, $description, $fabricant, $type)
    {
        // Met à jour les informations d'un produit dans la table 'medicaments'
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

        // Ajoute un événement pour enregistrer la modification du produit
        $this->addEvent($_SESSION['email'], 'edit', $reference);
    }

    public function login($email, $password)
    {
        // Vérifie l'authentification d'un utilisateur dans la table 'utilisateurs'
        $sql = "SELECT * FROM utilisateurs WHERE identifiant = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Authentification réussie, configure la session
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $password;

            // Ajoute un événement pour enregistrer la connexion de l'utilisateur
            $this->addEvent($_SESSION['email'], 'connected', '');
            return true;
        }
    }

    public function logout()
    {
        // Déconnecte l'utilisateur et détruit la session
        $this->addEvent($_SESSION['email'], 'disconnected', '');
        session_unset();
        session_destroy();
    }

    public function createAccount($identifiant, $hashed_password)
    {
        // Crée un nouveau compte utilisateur dans la table 'utilisateurs'
        $sql = "SELECT * FROM utilisateurs WHERE identifiant = :identifiant";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'identifiant' => $identifiant
        ]);
        if ($stmt->fetch()) {
            // L'utilisateur existe déjà, retourne false
            return false;
        }

        // Insère un nouvel utilisateur dans la table 'utilisateurs'
        $sql = "INSERT INTO utilisateurs (identifiant, mot_de_passe) VALUES (:identifiant, :mot_de_passe)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'identifiant' => $identifiant,
            'mot_de_passe' => $hashed_password
        ]);

        // Ajoute un événement pour enregistrer la création du compte utilisateur
        $this->addEvent($identifiant, 'accountCreate', '');

        return true;
    }

    public function getDashboardData()
    {
        // Récupère les statistiques du tableau de bord à partir de la table 'medicaments'
        $sql = "SELECT 
            COUNT(DISTINCT reference) AS total_produits,
            SUM(quantite) AS stock_total,
            COUNT(DISTINCT fabricant) AS total_fabricants,
            COUNT(DISTINCT type) AS total_types
            FROM medicaments";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Récupère le résultat et le retourne sous forme de tableau
        $result = $stmt->fetch();
        return [$result['total_produits'], $result['stock_total'], $result['total_fabricants'], $result['total_types']];
    }

}

