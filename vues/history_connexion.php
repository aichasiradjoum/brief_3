<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Connexions</title>
</head>
<body>
    <h2>Historique des Connexions</h2>

    <?php if (!empty($historique_connexions)) : ?>
        <table border="1">
            <tr>
                <th>Heure de Connexion</th>
                <th>Heure de Déconnexion</th>
            </tr>
            <?php foreach ($historique_connexions as $session) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($session['login_time']); ?></td>
                    <td>
                        <?php echo $session['logout_time'] ? htmlspecialchars($session['logout_time']) : "En cours..."; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Aucune connexion enregistrée.</p>
    <?php endif; ?>

    <a href="connexion.php">Retour au profil</a>
</body>
</html>
