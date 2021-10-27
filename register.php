<?php

session_start();

require_once 'connexion.php';

if (isset($_POST['submit'])) {

    $identifiant = $_POST['identifiant'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $uppercase = preg_match('@[A-Z]@', $mdp);
    $lowercase = preg_match('@[a-z]@', $mdp);
    $number    = preg_match('@[0-9]@', $mdp);
    $specialChars = preg_match('@[^\w]@', $mdp);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($mdp) < 8) {
        echo 'Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.';
    } else {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO login(identifiant,email,mdp) VALUES ( '$identifiant','$email', '$mdp')";
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header('location:login.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="" method="post">
        <center>
            <label for="identifiant">Identifiant : </label><br><br>
            <input type="text" name="identifiant" id="identifiant" required><br><br>
            <label for="email">Email : </label><br><br>
            <input type="email" name="email" id="email" required><br><br>
            <label for="mdp">Mot de passe : </label><br><br>
            <input type="password" name="mdp" id="mdp" required><br><br>
            <input type="submit" name="submit" value="Register">
        </center>
    </form>
</body>

</html>