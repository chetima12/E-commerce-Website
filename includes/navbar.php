
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Monoshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php 
        if(isset($_SESSION['auth'])){
          ?>
          <li class="nav-item">
          <a class="nav-link" href="product.php">produits</a>
        </li>
          <li class="nav-item">
          <a class="nav-link" href="Addproduct.php">Ajouter un produit</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="Params.php">Product Settings</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="ShowAllUser.php?id_admin= <?= $_SESSION['id_admin'] ?>">User Settings</a>
        </li>
         
          <?php
        }
        ?>
      
        <?php 
        if(isset($_SESSION['auth'])){
          ?>
          <li class="nav-item">
          <a class="nav-link" href="admin/function/connection/logout.php">Logout</a>
        </li>
          <?php
        }
        ?>
      </ul>
      <?php 
      if(isset($recupProduct) || isset($getcategorie)){
        ?>
        <form class="d-flex" role="search" method="get">
        <input class="form-control me-2" type="search" name="s" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
        <?php
      }
      ?>
    </div>
  </div>
</nav><br><br><br><br>
</body>
</html>
