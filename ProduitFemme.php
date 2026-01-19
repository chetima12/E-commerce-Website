<?php 
require('admin/function/model/PanierFunction.php');
require('admin/function/model/showproductFunction.php');
require('admin/function/model/SearchProduct.php');
//require('Panier.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <script src="product.js"></script>
    <link rel="stylesheet" href="product.css">
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
</head>
<body><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section class="jumbotron text-center">
                    <h1 class="display-4">Notre boutique, le chez-vous.</h1>
                    <p class="lead">Veuillez visiter nos differents produits a fin que vous puissiez trouver votre bohneur..</p>
                    
                </section>
                
            </div>
        </div>
    </div>
    <?php 
    include 'includes/navbar2.php';
    ?>
    <?php 
    if(isset($succesMsg)){
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <p class="alert alert-success text-center"><?= $succesMsg; ?></p>
                </div>
            </div>
        </div>
        <?php
    }
    if($recupProduct->rowCount() > 0){
        ?>
        <div class="row row-cols-1 row-cols-lg-5 g-4" style="margin-left: 30px; margin-top: 5px; margin-right:30px;">
            <?php
    
        while($produit = $recupProduct->fetch(PDO::FETCH_ASSOC)){
           if($produit['Categorie'] == 'Femme'){

             ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?= $produit['image'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                 <h5 class="card-title"><?= htmlspecialchars($produit['Titre']) ?></h5>
                                 <p class="card-text"><?= htmlspecialchars($produit['Description']) ?></p>
                            <div class="col-xs-8"><small><?= number_format($produit['Prix'], 2) ?> €</small></div><br>
                            <form method="post">
                                <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                                <button type="submit" name="add" class="btn btn-primary">Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            <?php
           }
        }
    }else{
        ?>
        <p class="text-danger text-center">Aucun resultat ne correspond a la recherche</p>
        <?php
    }
    ?>
        </div>
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>A propos de nous</h5>
                        <p>Nous sommes une entreprise specialisée dans la vente de produit de haute qualité.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Liens utiles</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Produit</a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Contactez-nous</h5>
                        <p>Adress : KC3 Django, Kribi</p>
                        <p>Téléphone : +237 692 806 782</p>
                        <p>Email : Chetimahusseni@gmail.com</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>&copy; 2025 Votre entreprise. Tous droits reservés.</p>
                    </div>
                </div>
            </div>
        </footer>
</body>
</html>