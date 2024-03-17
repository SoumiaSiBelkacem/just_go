<?php
session_start();

// Vérification des identifiants lors de la soumission du formulaire
if(isset($_POST['username']) && isset($_POST['password'])) {
    // Identifiants de l'administrateur (à remplacer par vos propres identifiants)
    $admin_username = "admin";
    $admin_password = "password";
    
    // Vérification des identifiants saisis par l'utilisateur
    if($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
        // Si les identifiants sont corrects, démarrer la session et rediriger vers la page2db.php
        $_SESSION['admin'] = true;
        header("Location:page1dn.html");
        exit; // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire
    } else {
        // Si les identifiants sont invalides, afficher un message d'erreur
        $error_message = "Identifiants invalides";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
</head>
<style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #4caf50;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: none;
            border-radius: 4px;
            background-color: #e9f5e9; /* Green background */
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            margin-bottom: 16px;
        }

       

       

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
<body>


<h2>Connexion Administrateur</h2>

<!-- Affichage du message d'erreur s'il y a lieu -->
<?php if(isset($error_message)) { ?>
    <p><?php echo $error_message; ?></p>
<?php } ?>

<div class="login-container">
    <h2>Connexion Administrateur</h2>

    <!-- Affichage du message d'erreur s'il y a lieu -->
    <?php if(isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>

    <form method="post">
        <div>
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Se connecter</button>
        </div>
    </form>

</div>

<footer>
    <p>PAGE ADMIN </p>
</footer>
</body>
</html>
