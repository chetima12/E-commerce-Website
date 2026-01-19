<?php 
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');

// Message d'information
$message = "";

// Création de la table tokens si elle n'existe pas (à faire une seule fois)
$pdo->exec("CREATE TABLE IF NOT EXISTS password_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires DATETIME NOT NULL
)");

// Étape 1 : Demande de réinitialisation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    if (empty($email)) {
        $message = '<div class="alert alert-danger">Veuillez saisir votre adresse email.</div>';
    } else {
        $stmt = $pdo->prepare("SELECT id_admin FROM admin WHERE Mail_admin = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Générer un token unique
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Enregistrer le token en base
            $insert = $pdo->prepare("INSERT INTO password_tokens (id_admin, token, expires) VALUES (?, ?, ?)");
            $insert->execute([$admin['id_admin'], $token, $expires]);

            // Générer le lien de réinitialisation (à envoyer par email en prod)
            $resetLink = "http://localhost/pass_ini.php?token=$token";
            $message = '<div class="alert alert-success">Un lien de réinitialisation a été généré :<br>
                <a href="' . $resetLink . '">' . $resetLink . '</a><br>
                (En production, ce lien serait envoyé par email)</div>';
        } else {
            $message = '<div class="alert alert-danger">Adresse email introuvable.</div>';
        }
    }
}

?>