<?php
require_once('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];
    $query = "SELECT * FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $produit_id, PDO::PARAM_INT);
    $stmt->execute();
    $produit = $stmt->fetch();

    if (!$produit) {
        echo "Produit non trouvé.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $image = $_POST['image']; 

        $update_query = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, image = :image WHERE id = :id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindParam(':nom', $nom);
        $update_stmt->bindParam(':description', $description);
        $update_stmt->bindParam(':prix', $prix);
        $update_stmt->bindParam(':image', $image);
        $update_stmt->bindParam(':id', $produit_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            echo "Produit mis à jour avec succès.";
            header("Location: admin_dashboard.php");  
            exit();
        } else {
            echo "Erreur lors de la mise à jour du produit.";
        }
    }
} else {
    echo "Produit non spécifié.";
}
?>


<form method="POST">
    <label for="nom">Nom du produit:</label>
    <input type="text" id="nom" name="nom" value="<?php echo $produit['nom']; ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $produit['description']; ?></textarea><br>

    <label for="prix">Prix:</label>
    <input type="number" id="prix" name="prix" value="<?php echo $produit['prix']; ?>" required><br>

    <label for="image">Image:</label>
    <input type="text" id="image" name="image" value="<?php echo $produit['image']; ?>" required><br>

    <button type="submit">Mettre à jour le produit</button>
</form>
