<?php
require_once('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];

    $query = "DELETE FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $produit_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Produit supprimé avec succès.";
        header("Location: admin_dashboard.php");  
        exit();
    } else {
        echo "Erreur lors de la suppression du produit.";
    }
} else {
    echo "Produit non trouvé.";
}
?>
