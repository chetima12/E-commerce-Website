<?php 
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');
// Étape 2 : Réinitialisation via le token
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $pdo->prepare("SELECT id_admin, expires FROM password_tokens WHERE token = ?");
    $stmt->execute([$token]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && strtotime($row['expires']) > time()) {
        // Traitement du formulaire de nouveau mot de passe
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            if (empty($newPassword) || empty($confirmPassword)) {
                $message = '<div class="alert alert-danger">Tous les champs sont obligatoires.</div>';
            } elseif ($newPassword !== $confirmPassword) {
                $message = '<div class="alert alert-danger">Les mots de passe ne correspondent pas.</div>';
            } else {
                // Mettre à jour le mot de passe
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE admin SET Password_admin = ? WHERE id_admin = ?");
                $update->execute([$hash, $row['id_admin']]);
                // Supprimer le token
                $pdo->prepare("DELETE FROM password_tokens WHERE token = ?")->execute([$token]);
                $message = '<div class="alert alert-success">Mot de passe réinitialisé avec succès.</div>';
            }
        }
    }
}
?>