<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "database_res"; // Nom de votre base de données

    // Connexion à la base de données MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Requête SQL préparée pour insérer les données dans la base de données
    $stmt = $conn->prepare("INSERT INTO res (nom, email, telephone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $telephone, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Vos données ont été bien reçues.');</script>";
    } else {
        echo "<script>alert('Erreur lors de l'insertion des données.');</script>";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la Réservation</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #4CAF50; /* Green title color */
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 2px solid #4CAF50; /* Green border */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #4CAF50; /* Green borders for table cells */
            text-align: left;
            padding: 12px;
            transition: background-color 0.3s; /* Smooth transition */
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e7f6e7; /* Light green on hover */
        }

        td:last-child {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        /* Navbar styles */
        nav {
            background-color: #27ae60; /* Blue */
            color: #fff;
            padding: 10px 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Style pour la bordure verte */
        .green-border {
            border: 2px solid #4CAF50; 
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); 
        }
    </style>
</head>
<body>


<nav>
    <a href="http://localhost/page1dn.html">Home</a>
    <a href="#">About</a>
    <a href="#">Contact</a>
</nav>

<h1>Résultat de la Réservation</h1>

<table>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Message</th>
        <th>Actions</th> 
    </tr>
    <?php
    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "database_res"; // Nom de votre base de données

    // Connexion à la base de données MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les réservations
    $sql_select = "SELECT * FROM res";
    $result = $conn->query($sql_select);

    // Afficher les réservations dans le tableau
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telephone'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td><a href='edit_reservation.php?email=" . $row['email'] . "' class='btn btn-primary' onclick='applyGreenBorder()'>Modifier</a></td>";
            echo "<td><a href='delete_reservation.php?email=" . $row['email'] . "' class='btn btn-danger'>Supprimer</a></td>";// Lien de suppression
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Aucune réservation trouvée.</td></tr>";
    }
    $conn->close();
    ?>

</table>

<footer>
    <center><h1>PAGE ADMIN</h1></center>
</footer>

<script>
    function applyGreenBorder() {
        document.getElementById('reservation-form').classList.add('green-border');
    }
</script>

</body>
</html>
