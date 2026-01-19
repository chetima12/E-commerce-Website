<?php 
require('admin/security/secure.php');
require('admin/config/database.php');
if(isset($_POST['envoi'])){
    if(isset($_FILES['img']) && !empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['cat'])){
        if($_FILES['img']['error'] == 0){
            $error = 1;
            if($_FILES['img']['size'] <= 3000000){

               $imageInfo = pathinfo($_FILES['img']['name']);
                $ExtensionImage = $imageInfo['extension'];
                $extensionArray = array('PNG', 'JPG', 'JPEG', 'WEBP');

                $adress = 'uploads/'.time().rand().rand(). '.' .$ExtensionImage;

                move_uploaded_file($_FILES['img']['tmp_name'], $adress);
                $error = 0;
    
                $img = $_FILES['img'];
                $titre = htmlspecialchars($_POST['titre']);
                $description = nl2br(htmlspecialchars($_POST['description']));
                $prix = nl2br(htmlspecialchars($_POST['prix']));
                $categorie = $_POST['cat'];

                $insertProduct = $bdd->prepare("INSERT INTO produit(image, Titre, Description, Prix, Categorie, id_admin, Nom_admin)
                VALUES(?, ?, ?, ?, ?, ?, ?)");
                $insertProduct->bindParam(1, $adress);
                $insertProduct->bindParam(2, $titre);
                $insertProduct->bindParam(3, $description);
                $insertProduct->bindParam(4, $prix);
                $insertProduct->bindParam(5, $categorie);
                $insertProduct->bindParam(6, $_SESSION['id_admin']);
                $insertProduct->bindParam(7, $_SESSION['nom']);
                $insertProduct->execute();

                header("location:Params.php");

                $succesMsg = 'Produit ajouté avec success.';
            }
            else{
                $errorMsg = 'Votre image doit avoir au minimum une taille de 3Mo.';
            }
        }
        else{
            $errorMsg = 'Erreur lors de l\'upload!';
        }
    }
    else{
        $errorMsg = 'Veuillez remplir tous les champs!';
    }
}
?>