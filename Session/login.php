<?php
session_start();
@$login = $_POST["login"];
@$pass = $_POST["pass"];
@$valider = $_POST["valider"];
$bonLogin = "user";
$bonPass = "1234";
$erreur = "";
if (isset($valider)) {
    if ($login == $bonLogin && $pass == $bonPass) {
        $_SESSION["autoriser"] = "oui";
        header("location:session.php");
    } else
        $erreur = "Mauvais login ou mot de passe!";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/login.css" />
    <style>
       
    </style>
</head>

<body onLoad="document.fo.login.focus()">
    <h1>Authentification</h1>
    <div class="erreur"><?php echo $erreur ?></div>
    <form name="fo" method="post" action="">
        <input type="text" name="login" placeholder="Login" /><br />
        <input type="password" name="pass" placeholder="Mot de passe" /><br />
        <input type="submit" name="valider" value="S'authentifier" />
    </form>
</body>

</html>