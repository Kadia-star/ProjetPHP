<?php
require_once('config.php'); 

// Récupérer tous les produits depuis la base de données
$query = "SELECT * FROM produits";
$stmt = $pdo->prepare($query);
$stmt->execute();

$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h1>Liste des Produits</h1>
        
        <?php if ($produits): ?>
            <div class="row">
                <?php foreach ($produits as $produit): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
                                <p class="card-text"><?php echo $produit['description']; ?></p>
                                <p><strong>Prix:</strong> €<?php echo number_format($produit['prix'], 2, ',', ' '); ?></p>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun produit disponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>
