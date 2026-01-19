<?php
require('pass_ini2.php');
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');
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
        // Afficher le formulaire de nouveau mot de passe
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Réinitialiser le mot de passe</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <script src="product.js"></script>
    <link rel="stylesheet" href="product.css">
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
        </head>
        <body class="bg-light">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white text-center">
                                <h3>Réinitialiser le mot de passe</h3>
                            </div>
                            <div class="card-body">
                                <?= $message ?>
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Réinitialiser</button>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <small><a href="login.php">Retour à la connexion</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
        exit;
    } else {
        $message = '<div class="alert alert-danger">Lien invalide ou expiré.</div>';
    }
}
?>