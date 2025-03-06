<?php
require 'config.php';

// Récupération de l'ID de la catégorie sélectionnée
$categorie_id = isset($_GET['categorie_id']) ? $_GET['categorie_id'] : '';

// Récupération des catégories
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll();

// Récupération des produits selon la catégorie sélectionnée
if (!empty($categorie_id)) {
    $sql = "SELECT * FROM produits WHERE categorie_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie_id]);
} else {
    $sql = "SELECT * FROM produits";
    $stmt = $pdo->query($sql);
}

$produits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrage des Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Nos Produits</h1>

    <!-- Formulaire de filtrage -->
    <form method="GET" action="categorie.php" class="mb-4">
        <label for="categorie_id">Filtrer par catégorie :</label>
        <select name="categorie_id" id="categorie_id" class="form-control" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?php echo $categorie['id']; ?>" <?php echo ($categorie['id'] == $categorie_id) ? 'selected' : ''; ?>>
                    <?php echo $categorie['nom']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Affichage des produits -->
    <div class="row">
        <?php if (count($produits) > 0): ?>
            <?php foreach ($produits as $produit): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?php echo $produit['image']; ?>" class="card-img-top" alt="<?php echo $produit['nom']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
                            <p class="card-text"><?php echo $produit['description']; ?></p>
                            <p class="card-text"><strong>€<?php echo number_format($produit['prix'], 2); ?></strong></p>
                            <a href="produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-primary">Voir Détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit trouvé pour cette catégorie.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
