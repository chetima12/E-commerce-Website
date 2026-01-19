<?php
// filepath: d:\slider\resetPassword.php
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');

// Message d'information
$message = "";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        $message = '<div class="alert alert-danger">Tous les champs sont obligatoires.</div>';
    } elseif ($newPassword !== $confirmPassword) {
        $message = '<div class="alert alert-danger">Les mots de passe ne correspondent pas.</div>';
    } else {
        // Vérifier si l'email existe
        $stmt = $pdo->prepare("SELECT id_admin FROM admin WHERE Mail_admin = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Mettre à jour le mot de passe (hashé)
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE admin SET Password_admin = ? WHERE id_admin = ?");
            $update->execute([$hash, $admin['id_admin']]);
            $message = '<div class="alert alert-success">Mot de passe réinitialisé avec succès.</div>';
        } else {
            $message = '<div class="alert alert-danger">Adresse email introuvable.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
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
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
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
                        <small><a href="LoginAdmin.php">Retour à la connexion</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>