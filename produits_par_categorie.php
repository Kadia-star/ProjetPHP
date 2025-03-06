<?php
require_once('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categorie_id = $_GET['id'];

    $query = "SELECT * FROM produits WHERE categorie_id = :categorie_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();

    $produits = $stmt->fetchAll();
} else {
    echo "<p>Catégorie non spécifiée.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits de la Catégorie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Produits de la Catégorie</h1>
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
                                <a href="produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-primary">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun produit trouvé dans cette catégorie.</p>
        <?php endif; ?>
    </div>
</body>
</html>
