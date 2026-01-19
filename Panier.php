<?php
// filepath: d:\slider\index.php
require('admin/security/secure.php');


// Connexion PDO à la base de données monoshop
$pdo = new PDO('mysql:host=localhost;dbname=monoshop;charset=utf8', 'root', '');

// Initialiser le panier comme tableau associatif id_produit => quantité
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier (quantité++)
if (isset($_POST['add'])) {
    $id = intval($_POST['id_produit']);
    if (!isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id] = 1;
    } else {
        $_SESSION['panier'][$id]++;
    }
}

// Supprimer une unité du produit du panier
if (isset($_POST['remove'])) {
    $id = intval($_POST['id_produit']);
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]--;
        if ($_SESSION['panier'][$id] <= 0) {
            unset($_SESSION['panier'][$id]);
        }
    }
}

// Supprimer tout le produit du panier
if (isset($_POST['delete'])) {
    $id = intval($_POST['id_produit']);
    unset($_SESSION['panier'][$id]);
}

// Récupérer tous les produits (requête préparée)
$stmt = $pdo->prepare("SELECT id_produit, image, Titre, Description, Prix FROM produit");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les produits du panier (requête préparée)
$panierProduits = [];
$total = 0;
if ($_SESSION['panier']) {
    $ids = array_keys($_SESSION['panier']);
    $in  = str_repeat('?,', count($ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT id_produit, image, Titre, Description, Prix FROM produit WHERE id_produit IN ($in)");
    $stmt->execute($ids);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['quantite'] = $_SESSION['panier'][$row['id_produit']];
        $row['total'] = $row['Prix'] * $row['quantite'];
        $total += $row['total'];
        $panierProduits[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier - Monoshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="Button.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        
        
        <hr>
        <h2 class="mb-4 text-center">Votre Panier</h2>
        <?php 
        if(isset($succesMsg)){
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <p class="alert alert-success text-center"><?= $succesMsg; ?></p>
                </div>
            </div>
        </div>
        <?php
    }
        ?>
        <?php if ($panierProduits): ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($panierProduits as $product): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['Titre']) ?>" style="width:60px;height:60px;object-fit:cover;"></td>
                            <td><?= htmlspecialchars($product['Titre']) ?></td>
                            <td><?= htmlspecialchars($product['Description']) ?></td>
                            <td><?= number_format($product['Prix'], 2) ?> €</td>
                            <td><?= $product['quantite'] ?></td>
                            <td><strong><?= number_format($product['total'], 2) ?> €</strong></td>
                            <td>
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="id_produit" value="<?= $product['id_produit'] ?>">
                                    <button type="submit" name="add" class="btn btn-success btn-sm" title="Ajouter">+</button>
                                </form>
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="id_produit" value="<?= $product['id_produit'] ?>">
                                    <button type="submit" name="remove" class="btn btn-warning btn-sm" title="Retirer">-</button>
                                </form>
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="id_produit" value="<?= $product['id_produit'] ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" title="Supprimer">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total du panier :</strong></td>
                            <td colspan="2" class="text-center text-primary"><strong><?= number_format($total, 2) ?> €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Votre panier est vide.</p>
        <?php endif; ?>
        <a href="pay.php" class="btn btn-success">Payer</a>
    </div>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php 
    include 'includes/navbar2.php';

    ?>
</body>
</html>