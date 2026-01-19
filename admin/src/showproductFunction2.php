<?php 
require('database2.php');

$regleProduit = $bdd->prepare("SELECT * FROM produit WHERE id_admin = ? ORDER BY id_produit DESC");
$regleProduit->execute(array($_SESSION['id_admin']));
?>