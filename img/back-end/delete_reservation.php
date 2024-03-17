<?php
session_start();

// Vérifie si un email de réservation est passé en paramètre
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "database_res"; // Remplacez par le nom de votre base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifie la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Requête SQL pour supprimer la réservation correspondante
    $stmt = $conn->prepare("DELETE FROM res WHERE email=?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<script>alert('Réservation supprimée avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de la réservation');</script>";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();

    // Rediriger vers la page précédente après la suppression
    header("Location: page2db.php");
    exit();
} else {
    // Si aucun email de réservation n'est passé en paramètre, rediriger vers la page précédente
    header("Location: page2db.php");
    exit();
}
?>
