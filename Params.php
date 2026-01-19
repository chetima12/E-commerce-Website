<?php
require('admin/security/secure.php');
require('admin/src/showproductFunction2.php');





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="Button.css">
</head>
<body>
    <?php 
    include 'includes/navbar.php';
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php 
                if(isset($errorMsg)){
                    ?>
                    <p class="alert alert-danger"><?= $errorMsg; ?></p>
                    <?php
                }elseif(isset($succesMsg)){
                    ?>
                    <p class="alert alert-success"><?= $succesMsg; ?></p>
                    <?php
                }
    if($regleProduit->rowCount() > 0){
         ?>
         <table class="table table-striped table bordered">
            <thead class="table-primary">
                <div class="d-flex">
                    <div class="p-2">
                        <a href="Addproduct.php"><button class="btn btn-success">Ajouter</button></a><br><br>
                    </div>
                    <div class="p-2">
                        <a href="ShowComments.php?id_comments= <?= $_SESSION['id_admin'] ?>" class="btn btn-primary">Voir Commentaires</a><br><br>
                    </div>
                    <div class="p-2">
                        <a href="ShowAllUser.php?id_admin= <?= $_SESSION['id_admin'] ?>" class="btn btn-primary">Voir Utilisateurs</a>
                    </div>
                </div>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Titre</th>
                    <th>prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php 
            while($prod = $regleProduit->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tbody>
                <tr>
                    <td><?= $prod['id_produit'] ?></td>
                    <td><img src="<?= $prod['image'] ?>" style="width:60px;height:60px;object-fit:cover;"></td>
                    <td><?= $prod['DateProduit']; ?></td>
                    <td><?= $prod['Titre']; ?></td>
                    <td><?= $prod['Prix']; ?></td>
                    <td style="text-align: center;">
                        <div class="d-flex">
                            <div class="p-2">
                                <a href="product.php?id= <?= $prod['id_produit'] ?>" class="btn btn-primary">Voir</a>
                            </div>
                            <div class="p-2">
                                <a href="EditProduct.php?id_produit= <?= $prod['id_produit']; ?>" class="btn btn-info">Modifier</a><br><br>
                            </div>
                            <div class="p-2">
                                <a href="admin/function/model/DeleteProduct.php?id_produit= <?= $prod['id_produit'] ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <?php
         }
            ?>
         </table>
         <?php
    }
    ?>
            </div>
        </div>
    </div>
</body>
</html>