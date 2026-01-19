<?php 
require('admin/security/secure.php');
require('admin/function/model/PostcommentFunction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact - MaBoutique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/asset/bootstrap-5.3.7-dist/css/bootstrap.css">
    <script type="text/javascript" src="admin/asset/bootstrap-5.3.7-dist/js/bootstrap.js"></script>
    <style>
        .contact-card {
            transition: transform 0.4s, box-shadow 0.4s, opacity 0.7s;
            opacity: 0;
            transform: translateY(40px);
        }
        .contact-card.visible {
            opacity: 1;
            transform: translateY(0);
            box-shadow: 0 8px 32px rgba(33,150,243,0.15);
        }
        .contact-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 16px 40px rgba(33,150,243,0.18);
        }
        .map-container {
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(33,150,243,0.10);
        }
    </style>
</head>
<?php 
    include 'includes/navbar2.php';
    ?>
<body class="bg-blue-50 min-h-screen">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7">
                <div class="card contact-card p-4">
                    <h2 class="mb-4 text-center text-primary">Contactez-nous</h2>
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
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="contenu" rows="4" placeholder="Votre message" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" name="envoi">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Géolocalisation Google Maps -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="map-container mb-4">
                    <iframe 
                        src="https://www.google.com/maps?q=48.8566,2.3522&hl=fr&z=14&output=embed"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Animation d'apparition de la carte contact
        document.addEventListener("DOMContentLoaded", function() {
            const card = document.querySelector('.contact-card');
            setTimeout(() => {
                card.classList.add('visible');
            }, 300);
        });
    </script>
</body>
</html>