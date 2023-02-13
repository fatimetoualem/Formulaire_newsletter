<?php

include "config.php";
include "functions.php";


$nomfichier = $argv[1];

if(!file_exists($nomfichier)){
    echo "Erreur : fichier '$nomfichier' introuvable";
    exit;
}

$file = fopen($nomfichier, "r");


$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdoStatement = $pdo->prepare('INSERT INTO subscribers (first_name, name, email, created_on) VALUES (?,?,?,?)');


while($row = fgetcsv($file)){
 
    $first_name = ucwords($row[0]);
    $name = ucwords($row[1]);
    $email = $row[2];

    $created_on = new DateTime();
    $created_on = $created_on->format("Y-m-d H:i:s");

    $email = str_replace(" ","", $email);

    if(validemail($email) != true){
        $pdoStatement->execute([$first_name, $name, $email, $created_on]);
    }else{
        echo"Cette mail est déjà dans la BDD";
    }
    
}

echo 'Import terminé!';