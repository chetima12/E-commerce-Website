
<?php 
require('admin/security/secure.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="Button.css">
</head>
<body>
  
    <?php 
    include 'includes/navbar2.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="text-align: center; justify-content:center;">
                <section class="jumbotron text-center fade-in">
                    <h1 class="display-4">Bienvenu cher(e) <?= $_SESSION['nom']; ?></h1>
                    <p class="lead">Nous somme ravis de vous acceuillir sur notre site web.</p>
                    <p><a href="product2.php?id_produit= <?= $_SESSION['id_admin'] ?>" class="btn btn-primary">Voir produits</a></p>
                </section>
              </div>
        </div>
    </div>


    <div class="d-flex justify-content-center align-items-center">
      <div class="p-2">
        
      </div>

      <div class="p-2">
        <div class="container">
    <div class="row">
        <div class="col-lg-9">
             <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="QEFD9256.PNG" class="d-block w-100" alt="...">
       <div class="carousel-caption d-none d-md-block">
           <h5>Third slide </h5>
            <p>Some representative placeholder content for the third slide.</p>
            <a href="product2.php" class="btn btn-primary">Voir</a>
        </div>
    </div>
    <div class="carousel-item">
      <img src="ELSY0974.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="MRBH1533.PNG" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        </div>
    </div>
   </div>
      </div>
      <div class="p-2"></div>
    </div><br><br>
    
            
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