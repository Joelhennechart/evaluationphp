<?php
include_once("../includes/head.php");

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
    <link rel="stylesheet" href="//public/css/style.css" />
    
</head>

<body onLoad="document.fo.login.focus()">
<section class="container">
        <div class="block p-20 form-container">
            <h1>Authentification</h1>
            <div class="erreur"><?php echo $erreur ?></div>
                <form name="fo" method="post" action=""> 
                    <div class="form-control">
                        <input type="text" name="login" placeholder="Login" /><br />
                        </div>
                    <div class="form-control">
                        <input type="password" name="pass" placeholder="Mot de passe" /><br />
                    </div>
                    <div class="form-control">
                        <input type="submit" class="btn btn-primary" value="VALIDER">
                    </div>
                </form>
            </div>
        </section>
    <?php include_once("../includes/footer.php") ?> ;    
</body>

</html>