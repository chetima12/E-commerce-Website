<?php 
require('admin/config/database.php');

$recupProduct = $bdd->prepare("SELECT id_produit, image, Titre, Description, Categorie, Prix FROM produit WHERE id_admin = ? ORDER BY id_produit DESC");
$recupProduct->execute(array($_SESSION['id_admin']));
?>