<?php
session_start();
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Utilisateurs autorisés</title>
</head>

<body>
    <section class="session">
        <h1>Zone autorisée pour les utilisateurs authentifiés</h1>
        <?= $userId ?>
    </section>
</body>

</html>