<?php
include('menu.php');
require 'config.php';  

$sql = "SELECT * FROM produits";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echanger-Etudiants - Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-image: url('images/background.jpg'); 
            background-size: cover;
            background-position: center;
        }
        #bienvenueSection {
            display: none;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 20px;
        }
        #bienvenueSection img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        /* Style du footer */
        footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        .social-icons a {
            color: white;
            font-size: 24px;
            margin: 0 15px;
            transition: 0.3s;
        }
        .social-icons a:hover {
            color: #f8f9fa;
            transform: scale(1.2);
        }
    </style>
</head>
<body>

<!-- Section cachée pour l'accueil avec un seul bouton -->
<div class="container text-center mt-5">
    <button id="btnBienvenue" class="btn btn-success btn-lg">Bienvenue à Tous!</button>
    
    <div class="container mt-4" id="bienvenueSection">
        <h2>Bienvenue sur Echanger-Etudiants !</h2>
        <p>Une plateforme dédiée aux échanges de produits entre étudiants.</p>
        <img src="images/apple-etudiant-.jpg" alt="Présentation du projet">
        <br><br>
        <button id="fermerBienvenue" class="btn btn-danger">Fermer</button>
    </div>
</div>

<div class="container mt-5">
    <h1>Nos Produits</h1>
    <div class="row">
        <?php foreach ($produits as $produit): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                <img src="images/<?php echo htmlspecialchars($produit['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produit['nom']); ?>" onerror="this.onerror=null; this.src='images/default.jpg';">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
                        <p class="card-text"><?php echo $produit['description']; ?></p>
                        <p class="card-text"><strong>€<?php echo number_format($produit['prix'], 2); ?></strong></p>
                        <a href="produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-primary">Voir Détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Pied de page -->
<footer>
    <p>© 2025 Echanger-Etudiants | Suivez-nous sur :</p>
    <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.google.com" target="_blank"><i class="fab fa-google"></i></a>
    </div>
</footer>

<script>
    document.getElementById("btnBienvenue").addEventListener("click", function() {
        document.getElementById("bienvenueSection").style.display = "block";
    });

    document.getElementById("fermerBienvenue").addEventListener("click", function() {
        document.getElementById("bienvenueSection").style.display = "none";
    });
</script>

</body>
</html>
