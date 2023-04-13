<?php
session_start();
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
    } elseif (strlen($passwd) < 10) {
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }

    /**
     * Execution de la requête INSERT INTO
     */
    if (!empty($passwd) || !empty($login)) {
        /**
         * On vérifie si le login et le mot de passe existent dans la table
         */
        $rqt = 'SELECT * FROM users WHERE login = :login ';
        $db_statement = $db_connexion->prepare($rqt);
        $db_statement->execute(
            array(
                ':login' => $login,
            )
        );

        /**
         * On executer une requete pour avoir un tableau associatif
         */
        $data = $db_statement->fetch(PDO::FETCH_ASSOC);
        /**
         * 
         */
        if (password_verify($passwd, $data['passwd'])) {
            $_SESSION['userID'] = $data['Id'];
            header('location: data/admin.php');
        } else {
            $message = "<span class='message'>Mot de passe incorrecte! </span>";
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}
?>


<div class="block p-20 form-container">
    <h1>Accès à votre compte</h1>
    <div class="form-control">
        <?= $message ?>
    </div>
    <form action="#" method="POST">
        <div class="form-control">

            <input type="text" name="login" id="login" placeholder="Login">
            <?= $errors['login'] ? '<p class="text-error">' . $errors['login'] . '</p>' : "" ?>

        </div>
        <div class="form-control">

            <input type="password" name="passwd" id="passwd" placeholder="Mot de passe">
            <?= $errors['passwd'] ? '<p class="text-error">' . $errors['passwd'] . '</p>' : "" ?>
        </div>

        <div class="form-control">
            <input type="submit" class="btn btn-primary" value="VALIDER">
        </div>

    </form>
    <a href="Create_compte.php"> Créer votre compte</a>
