
<?php 
require('admin/function/connection/Login.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - MaBoutique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="Button.css">

</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                 <?php 
                if(isset($errorMsg)){
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="alert alert-danger text-center"><?= $errorMsg; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                
                ?>  
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Connexion</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="pass" class="form-control" id="password" placeholder="Mot de passe" required>
                            </div>
                            <input type="submit" name="envoi" class="btn btn-primary w-100" value="Se connecter">
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Pas encore inscrit ? <a href="SigninAdmin.php">Inscrivez-vous</a></small>
                        <small>Mot de passe oublié ? <a href="password_ini.php">Réinnitialiser votre mot de passe.</a></small>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN -->
</body>
</html>