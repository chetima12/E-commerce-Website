<?php 
require('admin/config/database.php');
if(isset($_GET['id_produit']) && !empty($_GET['id_produit'])){
    $productId = $_GET['id_produit'];


    $getproduct = $bdd->prepare("SELECT id_produit, image, Titre, Description, Prix, Categorie, id_admin, Nom_admin FROM produit WHERE id_produit = ?");
    $getproduct->execute(array($productId));

    if($getproduct->rowCount() > 0){

        $product = $getproduct->fetch(PDO::FETCH_ASSOC);
        
        if($product['id_admin'] = $_SESSION['id_admin']){
            
            $image = $product['image'];
            $Titre = $product['Titre'];
            $Description = $product['Description'];
            $Prix = $product['Prix'];

            $Description = str_replace('<br />', '', $product['Description']);
            $Prix = str_replace('<br />', '', $product['Prix']);
           
        
            
        }else{
            $errorMsg = 'Vous n\'etes pas autorisé a modifier ce produit sans l\'accord d\'un autre administrateur!';
        }
    }
    else{
        $errorMsg = 'Aucun produit trouvé!';
    }
}
else{
    $errorMsg = 'Aucun identifaint ne correspond au produit!';
}
?>