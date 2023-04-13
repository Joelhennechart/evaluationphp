<?php
session_start();
if ($_SESSION["autoriser"] != "oui") {
    header("location:login.php");
    exit();
}
if (date("H") < 18)
    $bienvenue = "Bonjour et bienvenue dans votre espace personnel";
else
    $bienvenue = "Bonsoir et bienvenue dans votre espace personnel";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/session.css" />
    <style>

    </style>
</head>

<body onLoad="document.fo.login.focus()">
    <h1><?php echo $bienvenue ?></h1>
    [ <a href="deconnexion.php">Se déconnecter</a> ]
</body>

</html>