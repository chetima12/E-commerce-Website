<?php 
require('admin/config/database.php');
require('getInfoOfProduct.php');


if(isset($_POST['envoi'])){
    if(!empty($_FILES['img']) && !empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['cat'])){
        $Image = $_FILES['img'];

        if($_FILES['img']['error'] == 0){

            $Imageinfo = pathinfo($_FILES['img']['name']);
            $ImageExtension = $Imageinfo['extension'];
            $ExtensionArray = array('PNG', 'JPG', 'WEBP', 'JPEG');
            $Adress = 'uploads/'.time().rand().rand(). '.'.$ImageExtension;

            move_uploaded_file($_FILES['img']['tmp_name'], $Adress);
            $Titre_saisi = htmlspecialchars($_POST['titre']);
            $Description_saisi = nl2br(htmlspecialchars($_POST['description']));
            $Prix_saisi = nl2br(htmlspecialchars($_POST['prix']));
            $categorie = $_POST['cat'];
            

            $update = $bdd->prepare("UPDATE produit SET image = ?, Titre = ?, Description = ?, Prix = ?, Categorie = ? WHERE id_produit = ?");
            $update->execute(array($Adress, $Titre_saisi, $Description_saisi, $Prix_saisi, $categorie, $productId));

            $succesMsg = 'Produit modifié avec success.';
        }else{
            $errorMsg = 'Erreur lors de l\upload de l\'image';
        }
    }
    else{
        $errorMsg = 'Veuillez remplir tous les champs!';
    }
}
?>