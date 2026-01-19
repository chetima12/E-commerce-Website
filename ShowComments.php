<?php
require('admin/security/secure.php');
require('admin/function/model/ShowCommentFunction.php');
require('admin/function/model/SearchComments.php');




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
    <link rel="stylesheet" href="Button.css"></body>
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
    if(isset($IdComments)){
         ?>
         <table class="table table-striped table bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Contenu</th>
                    <th>Par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php 
            while($comments = $GetComments->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tbody>
                <tr>
                    <td><?= $comments['id_comments'] ?></td>
                    <td><?= $comments['DateComment']; ?></td>
                    <td><?= $comments['contenu']; ?></td>
                    <td><?= $comments['Nom_admin']; ?></td>
                    <td style="text-align: center;">
                        <a href="admin/function/model/DeleteComments.php?id_comments= <?= $comments['id_comments'] ?>" class="btn btn-danger">Supprimer</a>
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