<?php
require 'config.php';

$sql = "SELECT COUNT(*) FROM produits";
$stmt = $pdo->query($sql);
$count = $stmt->fetchColumn();

echo "La base de données est bien connectée ! Nombre de produits : " . $count;
?>
p