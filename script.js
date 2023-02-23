mapboxgl.accessToken = 'VOTRE_CLE_API_MAPBOX';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [-4.0237, 5.3322], // Coordonnées de la ville d'Abidjan
  zoom: 12 // Zoom par défaut de la carte
});

// Création du bouton Dashboard
var dashboardButton = document.createElement('div');
dashboardButton.id = 'dashboard-button';
dashboardButton.style.position = 'absolute';
dashboardButton.style.bottom = '20px';
dashboardButton.style.right = '20px';
dashboardButton.style.zIndex = '1';

var button = document.createElement('button');
button.innerHTML = 'Dashboard';

dashboardButton.appendChild(button);
document.body.appendChild(dashboardButton);

// Ajout d'un événement de clic sur le bouton Dashboard
button.addEventListener('click', function() {
  window.location.href = 'dashboard.php';
});

// Récupération des marqueurs depuis la base de données
<?php
  // Connexion à la base de données
  $dsn = 'mysql:host=localhost;dbname=nom_de_la_base_de_donnees';
  $username = 'nom_d_utilisateur';
  $password = 'mot_de_passe';
  $pdo = new PDO($dsn, $username, $password);

  // Récupération des coordonnées des marqueurs depuis la base de données
  $stmt = $pdo->query('SELECT longitude, latitude FROM marqueurs');
  $marqueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

// Boucle pour créer et placer les marqueurs sur la carte
<?php foreach ($marqueurs as $marqueur): ?>
  new mapboxgl.Marker()
    .setLngLat([<?=
