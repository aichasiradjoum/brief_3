<?php
session_start();
require_once '../modeles/user_modele.php';
require_once '../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../vues/connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT login_time, logout_time FROM sessions WHERE user_id = ? ORDER BY login_time DESC");
$stmt->execute([$user_id]);
$historique_connexions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure la vue
include '../vues/history_connexion.php';
