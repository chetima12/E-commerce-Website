<?php 
require('admin/function/model/productFunction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
</head>
<body class="bg-light">
    <?php 
    include 'includes/navbar.php';
    ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                     <?php 
            if(isset($errorMsg)){
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-danger text-center"><?= $errorMsg; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        elseif(isset($succesMsg)){
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="alert alert-success text-center"><?= $succesMsg; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
            ?>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Ajouter un produit</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="img" class="form-control" id="nom">
                            </div>
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" class="form-control" id="prenom" placeholder="Entrer un titre">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="text" class="form-control" placeholder="Entrer une description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">prix</label>
                                <input type="number" class="form-control" name="prix" placeholder="Entrer un prix">
                            </div>
                            <div class="mb-3">
                                <label for="categorie" class="form-label">Categorie</label>
                                <select name="cat" class="form-control">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                    <option value="Tandace">Tendance</option>
                                    <option value="Celebre">Celebre</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100" name="envoi">Publier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>