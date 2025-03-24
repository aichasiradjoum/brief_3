<?php
session_start(); // Démarre la session pour accéder aux variables $_SESSION
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Mon Profil</h2>
        <!-- Affichage des informations du client -->
        <form action="http://localhost/brief_3/controller/profile_controller.php" method="POST">
            <p>bienvenue sur ton dashboard <b><?php echo htmlspecialchars($_SESSION["user_name"]);?></b> </p>
            
            
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($_SESSION["user_name"]) ; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe (laisser vide si inchangé)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="history_connexion.php">Mon Historique</a>
            <a href="index.php">deconnexion</a>
        </form>
    </div>
</body>
</html>

