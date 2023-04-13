<?php

include_once("modele/db_connexion.php");

/**
 * Création de constante des erreurs possibles
 */

const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'le mot de passe ne répond pas au nombre de caractère demandé';

/**
 * Initialisation d'un tableau contenant les erreurs possibles lors des saisies 
 */

$errors = [
    'login' => '',
    'passwd' => '',
];
$message = '';

/**
 * Traitemet des données si la methode est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'login' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS

    ]);
    /**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $login = $_POST['login'] ?? '';
    $passwd = $_POST['passwd'] ?? '';


    /**
     * Remplissage du tableau concernant les erreurs possibles  
     */
    if (!$login) {
        $errors['login'] = ERROR_REQUIRED;
    }

    if (!$passwd) {
        $errors['passwd'] = ERROR_REQUIRED;
    } elseif (mb_strlen($passwd) < 10) {
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    /**
     * Execution de la requête INSERT INTO
     */
    if (($passwd) && ($login)) {
        /**
         * On vérifie si le login existe dans la table
         */
        $sql = 'SELECT login FROM users 
        WHERE login = :login ';
        $db_statement = $db_connexion->prepare($sql);
        $db_statement->execute(
            array(
                ':login' => $login
            )
        );

        /**
         * L'execution nous retourne une valeur, si <=0 alors on traite la requête
         */
        $nb = $db_statement->rowCount();
        if ($nb <= 0) {
            /**
             * On insert notre utilisateur
             */
            $rqt = "INSERT INTO users VALUES (DEFAUlT,:login,:passwd)";
            $db_statement = $db_connexion->prepare($rqt);
            $db_statement->execute(
                array(
                    ':login' => $login,
                    ':passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
            $message = "<span class='message'>Votre compte est crée ! </span>";
        } else {
            $message = "<span class='message'>Le login existe déja ! </span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once('includes/head.php'); ?>
    <link rel="stylesheet" href="public/css/style.css" />
    <title>Crée votre compte</title>

</head>

<body>
    <section class="container">

        <div class="block p-20 form-container">
            <h1>Accès à votre compte</h1>
            <div class="form-control">
                <?= $message ?>
            </div>
            <form action="" method="POST">
                <div class="form-control">

                    <input type="text" name="login" id="login" placeholder="Login">
                    <?= $errors['login'] ? '<p class="text-error">' . $errors['login'] . '</p>' : "" ?>

                </div>
                <div class="form-control">

                    <input type="text" name="passwd" id="passwd" placeholder="Mot de passe">
                    <?= $errors['passwd'] ? '<p class="text-error">' . $errors['passwd'] . '</p>' : "" ?>
                </div>

                <div class="form-control">
                    <input type="submit" class="btn btn-primary" value="VALIDER">
                </div>

            </form>
            <a href="index.php"> Accés à votre compte</a>
        </div>

    </section>
</body>

</html>