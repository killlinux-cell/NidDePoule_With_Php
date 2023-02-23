<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=offNid', 'root', '');

// Vérification du formulaire
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Vérification de l'existence de l'utilisateur dans la base de données
  $query = $pdo->prepare('SELECT * FROM admins WHERE username = ?');
  $query->execute([$username]);
  $admin = $query->fetch();

  if ($admin && password_verify($password, $admin['password'])) {
    // L'utilisateur est connecté avec succès
    header('Location: dashboard.php');
    exit();
  } else {
    // Les informations d'identification sont incorrectes
    echo "Nom d'utilisateur ou mot de passe incorrect.";
  }
}
?>





<!-- CREATE TABLE admins (
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);
 -->