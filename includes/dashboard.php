<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            transition: color 0.2s;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #fff;
            background: #495057;
        }
        .dashboard-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card.floating {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
        }
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s, transform 0.7s;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Commandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Paramètres</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Main -->
            <main class="col-md-10 ms-sm-auto px-4">
                <h1 class="mt-4 mb-4 fade-in">Dashboard Admin</h1>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card dashboard-card fade-in">
                            <div class="card-body">
                                <h5 class="card-title">Produits</h5>
                                <p class="card-text">Gérez vos produits ici.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card fade-in">
                            <div class="card-body">
                                <h5 class="card-title">Commandes</h5>
                                <p class="card-text">Suivez les commandes des clients.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card fade-in">
                            <div class="card-body">
                                <h5 class="card-title">Utilisateurs</h5>
                                <p class="card-text">Gérez les comptes utilisateurs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fade-in animation
        document.addEventListener("DOMContentLoaded", function() {
            const fadeEls = document.querySelectorAll('.fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.2 });
            fadeEls.forEach(el => observer.observe(el));
        });

        // Floating effect on dashboard cards
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('floating');
                });
                card.addEventListener('mouseleave', () => {
                    card.classList.remove('floating');
                });
            });
        });
    </script>
</body>
</html>