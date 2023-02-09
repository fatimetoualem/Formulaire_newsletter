<?php


// Inclusion des dépendances
require 'config.php';
require 'functions.php';

$errors = [];
$success = null;
$email = '';
$firt_name = '';
$name = '';

// Si le formulaire a été soumis...
if (!empty($_POST)) {

    // On récupère les données
    $email = trim($_POST['email']);
    $firt_name = trim($_POST['first_name']);
    $name = trim($_POST['name']);
    $firt_name = ucwords(strtolower($firt_name), " -");
    $name = ucwords(strtolower($name), " -");

    // On récupère l'origine
    $originSelected = $_POST['origin'];

    // Validation 
    if (!$email) {
        $errors['email'] = "Merci d'indiquer une adresse mail";
    }

    if (!$firt_name) {
        $errors['first_name'] = "Merci d'indiquer un prénom";
    }

    if (!$name) {
        $errors['name'] = "Merci d'indiquer un nom";
    }

    

    // Si tout est OK (pas d'erreur)
    if (empty($errors)) {

        // Ajout de l'email dans le fichier csv
        addSubscriber($email, $firt_name, $name, $originSelected);

        // Message de succès
        $success  = 'Merci de votre inscription';
    }
}

//////////////////////////////////////////////////////
// AFFICHAGE DU FORMULAIRE ///////////////////////////
//////////////////////////////////////////////////////

// Sélection de la liste des origines
$origins = getAllOrigins();

// Inclusion du template
include 'index.phtml';
