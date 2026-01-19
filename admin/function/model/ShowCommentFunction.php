<?php 
require('admin/config/database.php');

if(isset($_GET['id_comments']) && !empty($_GET['id_comments'])){

    $IdComments = $_GET['id_comments'];

    $GetComments = $bdd->prepare("SELECT id_comments, contenu, id_admin, Nom_admin, DateComment FROM comments WHERE id_comments = ?");
    $GetComments->execute(array($IdComments));
    
}else{
    $errorMsg = 'Aucun identifiant ne correspond a la publication!';
}
?>