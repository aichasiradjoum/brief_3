<?php
require_once '../config/database.php';

$nom = "Admin";
$email = "admin@example.com";
$password = "admin123"; // Mot de passe en clair (à changer)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash du mot de passe
$role = "admin";
$created_at = date("Y-m-d H:i:s");

$sql = "INSERT INTO users (nom, email, password, role, created_at) VALUES (:nom, :email, :password, :role, :created_at)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nom' => $nom,
    ':email' => $email,
    ':password' => $hashedPassword,
    ':role' => $role,
    ':created_at' => $created_at
]);

echo "Administrateur ajouté avec succès !";
?>