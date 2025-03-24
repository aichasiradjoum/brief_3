<?php
session_start();
require_once '../modeles/user_modele.php';
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Vérification du token CSRF
    // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    //     die("Token CSRF invalide");
    // }

    // Récupération et validation des données
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($nom) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Tous les champs sont requis.");
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérification si l'email existe déjà
    $userModel = new UserModel($pdo);
    if ($userModel->emailExists($email)) {
        die("Cet email est déjà utilisé.");
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Enregistrement de l'utilisateur
    $result = $userModel->registerUser($nom, $email, $hashed_password);
    
    if ($result) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: /vues/connexion.php");
        exit();
    } else {
        die("Erreur lors de l'inscription. Veuillez réessayer.");
    }
} else {
    die("Accès non autorisé");
}
// Inclure la vue
include '../vues/connexion.php';