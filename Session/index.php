<?php

//Création des constante des messages d'erreurs
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_LENGTH = "Le champ doit faire entre 2 et 10 caractères";
const ERROR_EMAIL = "L'email n'est pa valide";;

$errors = [
    'prenom' => '',
    'email' => ''
];

$prenom = $_POST['prenom'] ?? '';
$email = $_POST['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Exercice 3 Protection de nos inputs
    $_POST = filter_input_array(INPUT_POST, [
        'prenom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
    ]);
    //Utilisation l'opérateur de fusion null pour initialiser les deux variables

    // Gestion de la validation du champ prenom
    if (!$prenom) {
        $errors['prenom'] = ERROR_REQUIRED;
    } elseif (mb_strlen($prenom) < 2 || mb_strlen($prenom > 10)) {
        $errors['prenom'] = ERROR_LENGTH;
    }
    // Gestion de la validation du champ email
    if (!$email) {
        $errors['email'] = ERROR_REQUIRED;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ERROR_EMAIL;
    }
}

?>

<form action="" method="POST">
    <div>
        <label for="prenom">Prénom</label><br />
        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($prenom) ?>"><br />
        <?= $errors['prenom'] ? "<p style='color:red'>" . $errors['prenom'] . "</p>" : '' ?>
    </div>
    <div>
        <label for="email">Prénom</label><br>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($email) ?>"><br />
        <?= $errors['email'] ? "<p style='color:red'>" . $errors['email'] . "</p>" : '' ?>
    </div>
    <button type="submit">Submit</button>
</form>