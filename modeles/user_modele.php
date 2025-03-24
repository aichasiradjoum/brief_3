<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérifie si l'email existe déjà dans la base de données
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    // Enregistre un nouvel utilisateur
    public function registerUser($nom, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)");
        return $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'password' => $password
        ]);
    }

    // Récupère un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //recupere tous les utilisateurs
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Met à jour les informations d'un utilisateur
    public function updateUser($id, $nom, $email, $password = null) {
        if ($password) {
            $stmt = $this->pdo->prepare("UPDATE users SET nom = :nom, email = :email, password = :password WHERE id = :id");
            return $stmt->execute(['nom' => $nom, 'email' => $email, 'password' => $password, 'id' => $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET nom = :nom, email = :email WHERE id = :id");
            return $stmt->execute(['nom' => $nom, 'email' => $email, 'id' => $id]);
        }
        
    }

}
