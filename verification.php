<?php

session_start();


if (!isset($_SESSION['2facode'])) {
    header('location: login.php');
}

if (isset($_POST['submit'])) {
    if($_SESSION['2facode'] == $_POST['code']){
        die("Correct, Vous êtes connecté           - " . "<a href='logout.php'>Déconnecter</a>");
    }else{
        echo 'Code invalid';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
</head>

<body>
    <form action="" method="post">
        <label for="code">Le code reçu par mail:</label>
        <input type="text" name="code" id="code">
        <input type="submit" name="submit" value="valider">
    </form>
</body>

</html>