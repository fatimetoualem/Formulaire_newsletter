<?php
session_start();    

// Inclusion des dépendances
require 'config.php';
require 'functions.php';

if (!empty($_POST)) {
	$_SESSION["formulaire_envoye"] = $_POST;
	header("Location: ".$_SERVER["PHP_SELF"]);
	exit;
}

if (isset($_SESSION["formulaire_envoye"])) {
	$_POST = $_SESSION["formulaire_envoye"];
	unset($_SESSION["formulaire_envoye"]);
}

$errors = [];
$success = null;
$email = '';
$firt_name = '';
$name = '';
$insert = "";

// Si le formulaire a été soumis...
if (!empty($_POST)) {

    // On récupère les données
    $email = trim($_POST['email']);
    $firt_name = trim($_POST['first_name']);
    $name = trim($_POST['name']);
    $firt_name = ucwords(strtolower($firt_name), " -");
    $name = ucwords(strtolower($name), " -");

    $checkbox = $_POST["checkbox"];
   

    // On récupère l'origine
    $originSelected = $_POST['origin'];


    // Validation 
    if (!$email) {
        $errors['email'] = "Merci d'indiquer une adresse mail";
    }
    
    if(validemail($email) == true){
        $errors['email'] = "Cette mail est déjà utilisée";
    }

    if (!$firt_name) {
        $errors['first_name'] = "Merci d'indiquer un prénom";
    }

    if (!$name) {
        $errors['name'] = "Merci d'indiquer un nom";
    }

    if(!$checkbox){
        $errors['checkbox'] = "Merci de choisir au moins un";
    }
    
    // Si tout est OK (pas d'erreur)
    if (empty($errors)) {

        // Ajout de l'email dans le fichier csv
        $subId = addSubscriber($email, $firt_name, $name, $originSelected);


        foreach($checkbox as $i){
            addInterest($subId , $i);
        }
       

        // Message de succès
        $success  = 'Merci de votre inscription';

        //La variable session pour le message de success
        $_SESSION['message'] = $success;

        //Redirection vers la page index.php
        header('Location:index.php');
        exit();

    }
}

//////////////////////////////////////////////////////
// AFFICHAGE DU FORMULAIRE ///////////////////////////
//////////////////////////////////////////////////////

// Sélection de la liste des origines
$origins = getAllOrigins();
$checkboxs = getAllcheckboxs();

// Inclusion du template
include 'index.phtml';
