<?php
session_start(); // Démarre la session pour accéder aux variables $_SESSION
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Lien vers un fichier CSS (optionnel) -->
</head>
<body>
    <h2>Modifier l'utilisateur</h2>
    <form action="http://localhost/brief_3/controller/edit_user.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($_SESSION["user_name"]); ?>" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION["user_email"]); ?>" required>

        <label for="role">Rôle :</label>
        <select name="role" id="role">
            <option value="client" <?php echo ($_SESSION['user_role'] == 'client') ? 'selected' : ''; ?>>Client</option>
            <option value="admin" <?php echo ($_SESSION['user_role'] == 'admin') ? 'selected' : ''; ?>>Administrateur</option>
        </select>

        <label for="password">Nouveau mot de passe (laisser vide pour conserver l'ancien) :</label>
        <input type="password" name="password" id="password">

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="dashboard_admin.php">Retour au tableau de bord</a>
</body>
</html>