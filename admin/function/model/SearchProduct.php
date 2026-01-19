<?php 
require('admin/config/database.php');

$recupProduct = $bdd->prepare("SELECT * FROM produit ORDER BY id_produit DESC");
$recupProduct->execute();

if(isset($_GET['s']) && !empty($_GET['s'])){
    $searchInfo = $_GET['s'];

    $recupProduct = $bdd->prepare("SELECT id_produit, image, Titre, Description, Prix, Categorie FROM produit WHERE Titre LIKE '%".$searchInfo."%'");
    $recupProduct->execute();

}
?>