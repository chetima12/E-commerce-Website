<?php 
require('admin/security/secure.php');
require('admin/function/model/PostcommentFunction.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="Button.css">
    <script src="Home.js"></script>
    <link rel="stylesheet" href="Home.css">
</head>
<body>
    <?php 
    include 'includes/navbar2.php';
    ?>
    <div class="container">
        <?php 
        if(isset($errorMsg)){
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-danger"><?= $errorMsg; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        elseif(isset($succesMsg)){
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="alert alert-success"><?= $succesMsg; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <div class="col-lg-8">
                <form action="" role="form" class="form-horizontale" method="post">
                    <div class="form-group">
                        <label for="comments" class="col-sm-2 control-label">Commentaire</label>
                        <div class="col-sm-10">
                          <textarea name="contenu" class="form-control"></textarea>
                        </div>
                    </div><br>
                     <div class="form-group">
                       <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="envoi" value="Ajouter" class="btn btn-success">
                     </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>