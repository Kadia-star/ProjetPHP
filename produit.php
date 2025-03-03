<?php
// Connexion à la base de données
require_once('config.php'); // Assurez-vous d'inclure votre fichier de connexion à la base de données

// Vérifier si un ID de produit est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];

    // Récupérer les informations du produit
    $query = "SELECT * FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $produit_id, PDO::PARAM_INT);
    $stmt->execute();

    $produit = $stmt->fetch();

    if ($produit) {
        // Afficher les détails du produit
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails du Produit</title>
            <!-- Inclure Bootstrap pour le design -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container mt-5">
                <h2>Détails du Produit</h2>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Affichage de l'image du produit -->
                        <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>">
                        


                    </div>
                    <div class="col-md-6">
                        <!-- Informations sur le produit -->
                        <h3><?php echo $produit['nom']; ?></h3>
                        <p><strong>Description:</strong> <?php echo $produit['description']; ?></p>
                        <p><strong>Prix:</strong> €<?php echo number_format($produit['prix'], 2, ',', ' '); ?></p>
                        <a href="index.php" class="btn btn-primary">Retour à la liste des produits</a>
                    </div>
                </div>
            </div>

            <!-- Inclusion de Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Produit non trouvé.</p>";
    }
} else {
    echo "<p>Produit non spécifié.</p>";
}
?>
