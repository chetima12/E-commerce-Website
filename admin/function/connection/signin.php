<?php 
session_start();
require('admin/config/database.php');

    

if(isset($_POST['envoi'])){
    if(!empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['pass'])){
        $nom_par_defaut = 'Admin';
        $mail_par_defaut = 'admin@gmail.com';
        $pass_par_defaut = 'admin123';
        
        $nom = htmlspecialchars($_POST['nom']);
        $mail = htmlspecialchars($_POST['mail']);
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

       // if($nom === $nom_par_defaut AND $mail === $mail_par_defaut AND $pass === $pass_par_defaut){

            $verification = $bdd->prepare("SELECT Mail_admin FROM admin WHERE Mail_admin = ?");
            $verification->execute(array($mail));

            if($verification->rowCount() == 0){

                $InsertData = $bdd->prepare("INSERT INTO admin(Nom_admin, Mail_admin, Password_admin)
                VALUES(:nom, :mail, :pass)");

                $InsertData->bindParam(':nom', $nom);
                $InsertData->bindParam(':mail', $mail);
                $InsertData->bindParam(':pass', $pass);
                $InsertData->execute();

                $recupusers = $bdd->prepare("SELECT id_admin, Nom_admin, Mail_admin, Password_admin FROM admin WHERE Nom_admin = ? AND Mail_admin = ? AND Password_admin = ?");
                $recupusers->execute(array($nom, $mail, $pass));

           

                if($recupusers->rowCount() > 0){

                       $Data = $recupusers->fetch(PDO::FETCH_ASSOC);

                       $_SESSION['auth'] = true;
                       $_SESSION['id_admin'] = $Data['id_admin'];
                       $_SESSION['nom'] = $Data['Nom_admin'];
                       $_SESSION['mail'] = $Data['Mail_admin'];
                       $_SESSION['pass'] = $Data['Password_admin'];

                   if($nom == 'admin' && $mail == 'admin@gmail.com' && $pass == 'admin123'){

                       header("location:index.php");
                    }else{
                    
                     header("location:Home.php");
                    }
               }
               
            }
            else{
                $errorMsg = 'L\'utlisateur existe deja !';
            }
        //} 
       // else{
          //  $errorMsg = 'Acces interdit !';
       // }   
       
   
    }
    else{
        $errorMsg = 'Veuillez remplir tous les champs !';
    }
}
?>