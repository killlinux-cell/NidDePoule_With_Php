<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>

    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>


    <?php
    // Vérifier si un ID de marqueur est passé dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: tableau-de-bord.php');
        exit();
    }

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['description'])) {
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=offNid';
        $username = 'root';
        $password = '';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }

        // Récupérer les données du formulaire
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $description = $_POST['description'];

        // Mettre à jour le marqueur dans la base de données
        $sql = 'UPDATE marqueurs SET latitude = ?, longitude = ?, description = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$latitude, $longitude, $description, $id]);

        // Fermer la connexion à la base de données
        $stmt = null;
        $pdo = null;

        // Rediriger vers la page de tableau de bord
        header('Location: tableau-de-bord.php');
        exit();
    }

    // Récupérer le marqueur depuis la base de données
    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=offNid';
    $username = 'root';
    $password = '';
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // Récupérer les données du marqueur depuis la base de données
    $sql = 'SELECT latitude, longitude, description FROM marqueurs WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermer la connexion à la base de données
    $stmt = null;
    $pdo = null;
    ?>
    <!-- Formulaire de modification de marqueur -->
    <form method="POST">
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" value="<?php echo $result['latitude']; ?>"><br>
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" value="<?php echo $result['longitude']; ?>"><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $result['description']; ?>"><br>
        <input type="submit" value="Modifier">
    </form>




</body>

</html>