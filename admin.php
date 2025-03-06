<?php
session_start();
require 'config.php'; // Connexion à la base de données

// Vérifier si l'admin est déjà connecté
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

if ($admin && $password === "admin123") { 

    $_SESSION['admin'] = $admin['username'];
    header("Location: admin_dashboard.php");
    exit();
} else {
    $error = "Nom d'utilisateur ou mot de passe incorrect.";
}

}


// Vérifier si l'admin est connecté
if (isset($_SESSION['admin'])) {
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
            <h2>Tableau </h2>
            <p>Bienvenue, <?php echo $_SESSION['admin']; ?> !</p>
            <a href="?logout=true" class="btn btn-danger">Se déconnecter</a>
        </div>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h2>Connexion Admin</h2>
            <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
