<?php
session_start();
require_once '../modeles/user_modele.php';
require_once '../config/database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Vérification du token CSRF
    // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    //     die("Token CSRF invalide");
    // }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Tous les champs sont requis.");
    }

    $userModel = new UserModel($pdo);
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];

         // **ENREGISTRER LA CONNEXION**
         $stmt = $pdo->prepare("INSERT INTO sessions (user_id) VALUES (?)");
         $stmt->execute([$user['id']]);
         
        // Redirection en fonction du rôle
        if ($user['role'] === 'client') {
            header("Location: http://localhost/brief_3/vues/profil_client.php");
        } else {
            header("Location: http://localhost/brief_3/vues/dashboard_admin.php");
        }
        exit();
    } else {
        die("Email ou mot de passe incorrect.");
    }
} else {
    die("Accès non autorisé");
}

