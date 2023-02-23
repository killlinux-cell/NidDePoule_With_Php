<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Ajouter un marqueur sur la carte</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        #form {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1;
            background-color: white;
            padding: 10px;
        }

        #form label {
            display: block;
            margin-bottom: 5px;
        }

        #form input {
            width: 100%;
            margin-bottom: 10px;
        }

        #dashboard-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 1;
            background-color: white;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id='map'></div>
    <div id='form'>
        <form method='POST'>
            <label for='longitude'>Longitude:</label>
            <input type='text' name='longitude' id='longitude' required />
            <label for='latitude'>Latitude:</label>
            <input type='text' name='latitude' id='latitude' required />
            <button type='submit'>Ajouter</button>
        </form>
    </div>
    <button id='dashboard-button'>Dashboard</button>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoieW91YmV5b3UiLCJhIjoiY2xkN3ZlZXljMW5hbTNubW1lZmtoM2tsciJ9.tra-LL5GDEIkYZPA_XCCnw';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-4.0237, 5.3322], // Coordonnées de la ville d'Abidjan
            zoom: 12 // Zoom par défaut de la carte
        });

        // Récupération des marqueurs depuis la base de données
        <?php
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=offNid';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        // Récupération des coordonnées des marqueurs depuis la base de données
        $stmt = $pdo->query('SELECT longitude, latitude FROM marqueurs');
        $marqueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        // Boucle pour créer et placer les marqueurs sur la carte
        <?php foreach ($marqueurs as $marqueur) : ?>
            new mapboxgl.Marker()
                .setLngLat([<?= $marqueur['longitude'] ?>, <?= $marqueur['latitude'] ?>])
                .addTo(map);
        <?php endforeach; ?>

        // Gestion du clic sur le bouton "Dashboard"
        document.getElementById('dashboard-button').addEventListener('click', function() {
            // Rediriger vers la page de tableau de bord
            window.location.href = 'tableau-de-bord.php';
        });
    </script>
</body>

</html>