<?php 
session_start();
require('admin/config/database.php');
if(isset($_POST['envoi'])){
    if(!empty($_POST['nom']) && !empty($_POST['pass'])){

        $nom_saisi = htmlspecialchars($_POST['nom']);
        $pass_saisi = htmlspecialchars($_POST['pass']);
        

            $checkIfUserExist = $bdd->prepare("SELECT * FROM admin WHERE Nom_admin = ?");
            $checkIfUserExist->execute(array($nom_saisi));

            if($checkIfUserExist->rowCount() > 0){

                $verify = $checkIfUserExist->fetch(PDO::FETCH_ASSOC);

                if(password_verify($pass_saisi, $verify['Password_admin'])){

                    $_SESSION['auth'] = true;
                        $_SESSION['id_admin'] = $verify['id_admin'];
                        $_SESSION['nom'] = $verify['Nom_admin'];
                        $_SESSION['prenom'] = $verify['Prenom_admin'];
                        $_SESSION['mail'] = $verify['Mail_admin'];
                        $_SESSION['pass'] = $verify['Password_admin'];

                    if($nom_saisi == 'admin' && $pass_saisi == 'admin123'){

                         header("location:index.php");
                    }
                    else{
                        header("location:Home.php");
                    }

                   
                }
                else{
                    $errorMsg = 'Mot de passe incorrect !';
                }
            }
            else{
               $errorMsg = 'Acces interdit !';
            }
        
    }
    else{
        $errorMsg = 'Veuillez remlir tous les champs !';
    }
}
?>