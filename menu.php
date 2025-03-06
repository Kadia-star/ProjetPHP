<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echanger-Etudiants</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 2rem; 
        }
        .navbar-nav .nav-item {
            margin-right: 20px; 
        }
        .navbar-nav .nav-item .nav-link {
            font-weight: bold;
            
        }
        .bienvenue-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px; /* Réduire l'espace entre le menu et le contenu */
        }
        .bienvenue-container img {
            max-width: 300px; /* Réduire la taille de l'image */
            height: auto;
            margin-left: 20px; /* Ajuster l'espace entre le texte et l'image */
        }
        .bienvenue-text {
            margin-right: 30px; /* Ajouter un peu d'espace entre le texte et l'image */
        }
        .btn-welcome {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand text-white" href="index.php">Echanger-Etudiants</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="categorie.php">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="produit.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin.php">Admin</a>
                </li>
            </ul>
            <!-- Ajout du lien inscription à droite -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="inscription.php">Inscription</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container bienvenue-container">
        <div class="bienvenue-text">
            <h1>Bienvenue chez nous</h1>
            <p>"Une plateforme dédiée aux échanges de <br>
                produits et catégories pour étudiants"</p>
        </div>
        <div>
            <!-- Chemin modifié pour afficher votre image "etudiant.jpeg" -->
            <img src="images/etudiant.jpeg" alt="Image de bienvenue">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
