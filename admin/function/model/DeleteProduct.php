<?php
require('../../security/secure.php');
require('../../src/database2.php');
if(isset($_GET['id_produit']) && !empty($_GET['id_produit'])){
    $IdOfDeleteProduct = $_GET['id_produit'];

    $DeleteProduct = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
    $DeleteProduct->execute(array($IdOfDeleteProduct));

    if($DeleteProduct->rowCount() > 0){

        $deleteprod = $DeleteProduct->fetch(PDO::FETCH_ASSOC);

        if($deleteprod['id_admin'] == $_SESSION['id_admin']){

            $Delete = $bdd->prepare("DELETE FROM produit WHERE id_produit = ?");
            $Delete->execute(array($IdOfDeleteProduct));
            
            $succesMsg = 'Produit supprimé avec success.';

            header("location:../../../Params.php");

            


        }
        else{
            $errorMsg = 'Vous n\'etes pas autorisé a supprimer ce produit de la liste!';
        }
    }
    else{
        $errorMsg = 'Aucun produit n\'a ete touvé!';
    }
}
else{
    $errorMsg = 'Aucun id ne correspond au produit!';
}
?>