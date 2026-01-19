<?php 
require('admin/config/database.php');

if(isset($_POST['envoi'])){
    if(!empty($_POST['email']) && !empty($_POST['contenu'])){
        $contenu = nl2br(htmlspecialchars($_POST['contenu']));
        $email = htmlspecialchars($_POST['email']);
        $Id_admin = $_SESSION['id_admin'];
        $nomAdmin = $_SESSION['nom'];

        $insertComments = $bdd->prepare("INSERT INTO comments( Mail, contenu, id_admin, Nom_admin)
        VALUES(?, ?, ?, ?)");
        $insertComments->bindParam(1, $email);
        $insertComments->bindParam(2, $contenu);
        $insertComments->bindParam(3, $Id_admin);
        $insertComments->bindParam(4, $nomAdmin);
        $insertComments->execute();

        $succesMsg = 'Commentaire envoyé avec succes.';
    }else{
        $errorMsg = 'Veuillez renseigner ce champ!';
    }
}
?>