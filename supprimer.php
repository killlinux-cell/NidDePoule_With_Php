<?php
// Vérifier si un ID de marqueur est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: tableau-de-bord.php');
    exit();
}

// Supprimer le marqueur dans la base de données
// Connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données
$database = 'offNid'; // Nom de la base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Supprimer le marqueur dans la base de données
    $sql = 'DELETE FROM marqueurs WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Fermer la connexion à la base de données
    $pdo = null;

    // Rediriger vers la page de tableau de bord
    header('Location: tableau-de-bord.php');
    exit();
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
