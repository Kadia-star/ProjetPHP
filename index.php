<?php
require 'config.php';  // Connexion à la base de données

// Récupérer tous les produits
$sql = "SELECT * FROM produits";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini E-Commerce - Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Nos Produits</h1>
        <div class="row">
            <?php foreach ($produits as $produit): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/
                        <?php echo $produit['image']; ?>" class="card-img-top" alt="<?php echo $produit['nom']; ?>">
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
</body>
</html>
