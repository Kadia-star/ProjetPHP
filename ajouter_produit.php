<?php
require_once('config.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_FILES['image']['name']; 
    $categorie_id = $_POST['categorie_id'];

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
    $sql = "INSERT INTO produits (nom, description, prix, image, categorie_id) 
            VALUES (:nom, :description, :prix, :image, :categorie_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':categorie_id', $categorie_id);

    if ($stmt->execute()) {
        echo "Produit ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Produit</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom du Produit</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix (€)</label>
                <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select class="form-control" id="categorie_id" name="categorie_id" required>
                    <?php
                    // Récupérer les catégories depuis la base de données
                    $sql = "SELECT * FROM categories";
                    $stmt = $pdo->query($sql);
                    while ($categorie = $stmt->fetch()) {
                        echo "<option value='{$categorie['id']}'>{$categorie['nom']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
