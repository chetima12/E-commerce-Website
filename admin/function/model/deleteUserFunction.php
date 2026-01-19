<?php 
//require('admin/security/secure.php');
require('../../src/database2.php');

if(isset($_GET['id_admin']) && !empty($_GET['id_admin'])){
    $Idadmin2 = $_GET['id_admin'];

    $deleteUser = $bdd->prepare("SELECT * FROM admin WHERE id_admin = ?");
    $deleteUser->execute(array($Idadmin2));

    if($deleteUser->rowCount() > 0){

        $users = $deleteUser->fetch(PDO::FETCH_ASSOC);

        if($users['id_admin'] = 1){

            $delete = $bdd->prepare("DELETE FROM admin WHERE id_admin = ?");
            $delete->execute(array($Idadmin2));

            header("location:../../../ShowAllUser.php");
        }
        else{
            $errorMsg = 'Vous n\'etes pas autorisé a supprimer cet utilisateur!';
        }
    }
    
}else{
    $errorMsg = 'Aucun id ne correspond a l\'utilisateur!';
}
?>