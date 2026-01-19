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

    $succesMsg = 'Vous venez d\'ajouter un produit dans votre panier.';
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
    $succesMsg = 'Vous venez de retirer  un produit de votre panier.';
}

// Supprimer tout le produit du panier
if (isset($_POST['delete'])) {
    $id = intval($_POST['id_produit']);
    unset($_SESSION['panier'][$id]);

    $succesMsg = 'Vous venez de supprimer un produit de votre panier.';
}

// Récupérer tous les produits (requête préparée)
$stmt = $pdo->prepare("SELECT id_produit, image, Titre, Description, Prix, Categorie FROM produit");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les produits du panier (requête préparée)
$panierProduits = [];
$total = 0;
if ($_SESSION['panier']) {
    $ids = array_keys($_SESSION['panier']);
    $in  = str_repeat('?,', count($ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT id_produit, image, Titre, Description, Prix, Categorie FROM produit WHERE id_produit IN ($in)");
    $stmt->execute($ids);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['quantite'] = $_SESSION['panier'][$row['id_produit']];
        $row['total'] = $row['Prix'] * $row['quantite'];
        $total += $row['total'];
        $panierProduits[] = $row;
    }
}
?>