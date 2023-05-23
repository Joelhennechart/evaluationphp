<?php

/**
 * Création d'une instance PDO pour se connecter à la base de données stagiaires
 */
$dsn = "mysql:host=localhost;dbname=evaluation_php;charset=utf8";
$user = "root";
$password = "";
try {
    $db_connexion = new PDO($dsn, $user, $password);
    $db_connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $db_connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Impossible d'accéder à la base de données<br/>";
}