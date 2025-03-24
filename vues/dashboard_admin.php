<?php
session_start();
require_once '../config/database.php';
require_once '../modeles/user_modele.php';

// Vérification de l'authentification et du rôle
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: connexion.php");
    exit();
}

$userModel = new UserModel($pdo);
$users = $userModel->getAllUsers(); // Fonction qui récupère tous les utilisateurs

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Administrateur</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Lien vers un fichier CSS -->
</head>
<body>
    <header>
        <h1>Tableau de Bord</h1>
        <nav>
            <a href="logout.php">Déconnexion</a>
        </nav>
    </header>

    <section>
        <h2>Aperçu des Utilisateurs</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <a href="form_edit.php">Modifier</a> | 
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
