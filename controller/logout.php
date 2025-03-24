session_start();
require_once '../config/database.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // **Mettre à jour l'heure de déconnexion**
    $stmt = $pdo->prepare("UPDATE sessions SET logout_time = CURRENT_TIMESTAMP WHERE user_id = ? AND logout_time IS NULL ORDER BY login_time DESC LIMIT 1");
    $stmt->execute([$user_id]);

    // Détruire la session
    session_unset();
    session_destroy();
}

// Redirection vers la page de connexion
header("Location: ../vues/connexion.php");
exit();
