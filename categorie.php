<?php
require 'config.php';  

// Vérifier si une catégorie est sélectionnée
$categorie_id = isset($_GET['categorie_id']) ? $_GET['categorie_id'] : '';

// Récupérer tous les produits (ou filtrer selon la catégorie)
if ($categorie_id) {
    // Récupérer les produits d'une catégorie spécifique
    $sql = "SELECT * FROM produits WHERE categorie_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie_id]);
} else {
    // Récupérer tous les produits
    $sql = "SELECT * FROM produits";
    $stmt = $pdo->query($sql);
}

$produits = $stmt->fetchAll();

// Récupérer toutes les catégories pour afficher dans le menu déroulant
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll();
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
        <h1>Nos Produits Sur Web</h1>

        <!-- Formulaire de filtrage par catégorie -->
        <form method="GET" action="index.php" class="mb-4">
            <div class="form-group">
                <label for="categorie_id">Filtrer par catégorie :</label>
                <select name="categorie_id" id="categorie_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['id']; ?>" <?php echo ($categorie['id'] == $categorie_id) ? 'selected' : ''; ?>>
                            <?php echo $categorie['nom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Affichage des produits -->
        <div class="row">
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
        </div>
    </div>
</body>
</html>
