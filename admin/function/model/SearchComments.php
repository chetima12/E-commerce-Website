<?php 
require('admin/config/database.php');

$GetComments = $bdd->prepare("SELECT * FROM comments ORDER BY id_comments DESC");
$GetComments->execute();

if(isset($_GET['s']) && !empty($_GET['s'])){
    $searchInfo = $_GET['s'];

    $GetComments = $bdd->prepare("SELECT id_comments, contenu, Nom_admin, DateComment FROM comments WHERE Nom_admin LIKE '%".$searchInfo."%'");
    $GetComments->execute();

}
?>