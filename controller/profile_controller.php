<?php
session_start();
require_once '../modeles/user_modele.php';
require_once '../config/database.php';


// Vérification de l'authentification
if(!isset($_SESSION["user_id"])) {
    header("location : connexion.php");
    exit;
}


$userModel = new UserModel($pdo);
$user = $userModel->getUserById($_SESSION['user_id']);

if (!$user) {
    die("Utilisateur introuvable.");
}

// Mise à jour des informations personnelles
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($nom) || empty($email)) {
        die("Tous les champs sont requis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format d'email invalide.");
    }

    // Mise à jour du mot de passe si fourni
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashedPassword = $user['password']; // Conserver l'ancien mot de passe
    }

    $updateSuccess = $userModel->updateUser($_SESSION['user_id'], $nom, $email, $hashedPassword);
    
    if ($updateSuccess) {
        $_SESSION['user_name'] = $nom; // Mise à jour de la session
        header("Location: /vues/profil_client.php?success=1");
        exit();
    } else {
        die("Erreur lors de la mise à jour.");
    }
}

?>
