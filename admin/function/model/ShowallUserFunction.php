<?php 
require('admin/config/database.php');
if(isset($_GET['id_admin']) && !empty($_GET['id_admin'])){
    $Idadmin = $_GET['id_admin'];

    $getAllUsers = $bdd->prepare("SELECT * FROM admin WHERE id_admin != 1");
    $getAllUsers->execute();
}



?>