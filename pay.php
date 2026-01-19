<?php
// filepath: d:\slider\pay.php
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');

// Message d'information
$message = "";

// Exemple de récupération du total du panier (à adapter selon votre logique)
$total = 0;
if (isset($_SESSION['panier']) && $_SESSION['panier']) {
    $ids = array_keys($_SESSION['panier']);
    $in  = str_repeat('?,', count($ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT id_produit, Prix FROM produit WHERE id_produit IN ($in)");
    $stmt->execute($ids);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $total += $row['Prix'] * $_SESSION['panier'][$row['id_produit']];
    }
}

// Traitement du formulaire de paiement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $numero = trim($_POST['numero'] ?? '');
    $exp = trim($_POST['exp'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');

    if (empty($nom) || empty($numero) || empty($exp) || empty($cvv)) {
        $message = '<div class="alert alert-danger text-center">Tous les champs sont obligatoires.</div>';
    } elseif (!preg_match('/^\d{16}$/', $numero)) {
        $message = '<div class="alert alert-danger text-center">Numéro de carte invalide.</div>';
    } elseif (!preg_match('/^\d{2}\/\d{2}$/', $exp)) {
        $message = '<div class="alert alert-danger text-center">Date d\'expiration invalide.</div>';
    } elseif (!preg_match('/^\d{3,4}$/', $cvv)) {
        $message = '<div class="alert alert-danger text-center">CVV invalide.</div>';
    } else {
        // Ici, vous pouvez enregistrer la commande ou le paiement en base
        $message = '<div class="alert alert-success text-center">Paiement effectué avec succès !</div>';
        // $_SESSION['panier'] = []; // Vider le panier après paiement si besoin
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement - MaBoutique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pay-card {
            transition: transform 0.4s, box-shadow 0.4s, opacity 0.7s;
            opacity: 0;
            transform: translateY(40px);
        }
        .pay-card.visible {
            opacity: 1;
            transform: translateY(0);
            box-shadow: 0 8px 32px rgba(33,150,243,0.15);
        }
        .pay-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 16px 40px rgba(33,150,243,0.18);
        }
    </style>
</head>
<?php 
include 'includes/navbar2.php';
?>
<body class="bg-blue-50 min-h-screen">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card pay-card p-4">
                    <h2 class="mb-4 text-center text-primary">Paiement</h2>
                    <?= $message ?>
                    <form method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom sur la carte</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numéro de carte</label>
                            <input type="text" class="form-control" id="numero" name="numero" maxlength="16" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exp" class="form-label">Expiration (MM/AA)</label>
                                <input type="text" class="form-control" id="exp" name="exp" placeholder="MM/AA" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" required>
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <span class="fw-bold text-primary">Total à payer : <?= number_format($total, 2) ?> €</span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Payer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation d'apparition de la carte paiement
        document.addEventListener("DOMContentLoaded", function() {
            const card = document.querySelector('.pay-card');
            setTimeout(() => {
                card.classList.add('visible');
            }, 300);
        });
    </script>
</body>
</html>