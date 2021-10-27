<?php

session_start();
//session_destroy();

require_once 'connexion.php';

if (isset($_POST['login'])) {
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $sql = "SELECT * FROM `login` WHERE `identifiant`=? AND `mdp`=? ";
    $query = $conn->prepare($sql);
    $query->execute(array($identifiant, $mdp));
    $row = $query->rowCount();
    $fetch = $query->fetch();
    if ($row > 0) {

        $code = rand(000000,999999);

        $_SESSION['2facode'] = $code;

        $from = "noreply@domain.com";
        $headers = "From:" . $from;
        
        mail ($fetch['email'] ,"Code" , $code, $headers);

        header('location: verification.php');

        //die('Informations corrects !');
    } else {
        echo "Identifiant ou mot de passe incorrect !";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <center>
            <label for="identifiant">Identifiant : </label><br><br>
            <input type="text" name="identifiant" id="identifiant" required><br><br>
            <label for="mdp">Mot de passe : </label><br><br>
            <input type="password" name="mdp" id="mdp" required><br><br>
            <input type="submit" name="reset" value="Reset"> <input type="submit" name="login" value="Login">
        </center>
    </form>
</body>

</html>