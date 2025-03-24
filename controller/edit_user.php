<?php
session_start();
require_once '../config/database.php';
require_once '../modeles/user_modele.php';

// Vérification de l'authentification et du rôle administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../vues/connexion.php");
    exit();
}

// Vérification de l'ID utilisateur passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID utilisateur invalide.");
}

$userModel = new UserModel($pdo);
$user = $userModel->getUserById($_GET['id']);

if (!$user) {
    die("Utilisateur introuvable.");
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
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

    // Mise à jour de l'utilisateur en base de données
    $updateSuccess = $userModel->updateUser($user['id'], $nom, $email, $hashedPassword, $role);

    if ($updateSuccess) {
        header("Location: admin_dashboard.php?success=1");
        exit();
    } else {
        die("Erreur lors de la mise à jour.");
    }
}
?>

