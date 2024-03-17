<?php
session_start();

$row = []; // Définition d'un tableau vide pour éviter les avertissements si $row n'est pas défini

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update reservation in the database
    $email = $_POST['email'];
    $nom = htmlspecialchars($_POST['nom']);
    $new_email = htmlspecialchars($_POST['new_email']);
    $telephone = htmlspecialchars($_POST['telephone']);

    // Database connection
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "database_res"; // Remplacez par le nom de votre base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE res SET nom=?, email=?, telephone=? WHERE email=?");
    $stmt->bind_param("ssss", $nom, $new_email, $telephone, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Réservation mise à jour avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de la mise à jour de la réservation');</script>";
    }

    $stmt->close();
    $conn->close();
}

// Fetch reservation details for editing
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Database connection
    $servername = "localhost";
    $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
    $password = ""; // Remplacez par votre mot de passe MySQL
    $dbname = "database_res"; // Remplacez par le nom de votre base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM res WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la réservation</title>

  <form action="page2db.php" method="post">
    <input type="hidden" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
    <div class="form-group">
        <b>  <label for="nom">Nom:</label><b/>
        <input type="text" class="form-control custom-input-border" id="nom" name="nom" value="<?php echo isset($row['nom']) ? $row['nom'] : ''; ?>">
    </div>

    <br>     <br> 
    <div class="form-group">
        <b>  <label for="new_email">Nouveau Email:</label><b/>
        <input type="email" class="form-control custom-input-border" id="new_email" name="new_email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
    </div>

     <br>       <br> 
    <div class="form-group">
       <b> <label for="telephone">Nouveau Numéro de téléphone:</label><b/>
        <input type="text" class="form-control custom-input-border" id="telephone" name="telephone" value="<?php echo isset($row['telephone']) ? $row['telephone'] : ''; ?>">
    </div>
     <center><button type="submit" class="btn-custom">Modifier</button></center> 
</form>

<style>
    /* Style pour les champs de saisie */
    .form-control {
        width: 100%; /* Prendre toute la largeur disponible */
        border: 1px solid #4CAF50; /* Bordure verte */
        border-radius: 8px; /* Arrondi des bords */
        padding: 10px; /* Espacement du texte à l'intérieur du champ */
        box-sizing: border-box; /* Inclure la bordure dans la largeur totale */
    }

    /* Style pour le bouton */
    .btn-custom {
        background-color: #4CAF50; /* Couleur de fond */
        border: none;
        color: white; /* Couleur du texte */
        padding: 10px 20px; /* Espacement du texte à l'intérieur du bouton */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 8px; /* Arrondi des bords */
        border: 2px solid #4CAF50; /* Bordure */
    }

    /* Style pour le bouton au survol */
    .btn-custom:hover {
        background-color: #45a049; /* Couleur de fond au survol */
    }
</style>


    
</body>
</html>
