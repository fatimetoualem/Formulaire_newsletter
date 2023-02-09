<?php

include "config.php";



$nomfichier = $argv[1];

if(!file_exists($nomfichier)){
    echo "Erreur : fichier '$nomfichier' introuvable";
    exit;
}

$file = fopen($nomfichier, "r");


$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdoStatement = $pdo->prepare('INSERT INTO subscribers (first_name, name, email) VALUES (?,?,?)');


while($row = fgetcsv($file)){
 
    $first_name = $row[0];
    $name = ucwords($row[1]);
    $email = $row[2];

    $first_name = strtolower($first_name);
    $first_name = ucwords($first_name);

    $pdoStatement->execute([$first_name, $name, $emai]);
}

echo 'Import terminé!';