<!DOCTYPE html>
<html>

<head>
    <title>Tableau de données</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Tableau de données</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
                <th>DESCRIPTION</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ajouter ici les lignes de données -->

            <?php
            // Informations de connexion à la base de données
            $dsn = 'mysql:host=localhost;dbname=offNid';
            $username = 'root';
            $password = '';

            try {
                // Connexion à la base de données
                $pdo = new PDO($dsn, $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupérer les données depuis la base de données
                $sql = 'SELECT id, latitude, longitude, description FROM marqueurs';
                $result = $pdo->query($sql);

                // Afficher les données dans le tableau
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['latitude'] . '</td>';
                    echo '<td>' . $row['longitude'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td><a href="modifier.php?id=' . $row['id'] . '">Modifier</a> | <a href="supprimer.php?id=' . $row['id'] . '">Supprimer</a></td>';
                    echo '</tr>';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
            $pdo = null;
            ?>


        </tbody>
    </table>
</body>

</html>