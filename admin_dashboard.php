<?php
session_start();
require 'config.php'; // Connexion à la base de données

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php"); // Rediriger vers la page de connexion si l'admin n'est pas connecté
    exit();
}

// Récupérer tous les produits
$query = "SELECT * FROM produits";
$stmt = $pdo->prepare($query);
$stmt->execute();
$produits = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tableau de Bord Admin</h2>
        <p>Bienvenue, <?php echo $_SESSION['admin']; ?> !</p>
        <a href="admin.php?logout=true" class="btn btn-danger">Se déconnecter</a>

        <h3 class="mt-4">Liste des Produits</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><?php echo $produit['nom']; ?></td>
                        <td><?php echo $produit['description']; ?></td>
                        <td><?php echo '€' . number_format($produit['prix'], 2, ',', ' '); ?></td>
                        <td><img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" width="50"></td>
                        <td>
                        <td>
                            <a href="modifier_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-warning btn-sm mr-2 mt-3 mb-3">Modifier</a>
                            <a href="supprimer_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-danger btn-sm mt-3 mb-3">Supprimer</a>
                        </td>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="ajouter_produit.php" class="btn btn-success">Ajouter un nouveau produit</a>
    </div>
</body>
</html>
