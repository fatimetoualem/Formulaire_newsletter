<?php

/**
 * Récupère tous les enregistrements de la table origins
 */
function conexionBDD()
{
    // Construction du Data Source Name
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;

    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');

    return $pdo;
}
function getAllOrigins()
{
    $pdo = conexionBDD();

    $sql = 'SELECT *
            FROM origines
            ORDER BY origine_label';

    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

function getAllcheckboxs()
{
    $pdo = conexionBDD();

    $sql = 'SELECT * FROM checkbox ORDER BY label_checkbox';
     
    $query = $pdo->prepare($sql);
    $query->execute();

    return $query->fetchAll();
}

function validemail($email)
{
    $pdo = conexionBDD();

     $varifymail = $pdo->prepare("SELECT * FROM subscribers WHERE email=?");
     $varifymail->execute([$email]);
     $mailexiste = $varifymail->fetch();

     if($mailexiste != 0){
        return true;
     }
     else{
        return false;
     }
}



/**
 * Ajoute un abonné à la liste des emails
 */
function addSubscriber(string $email, string $first_name, string $name, int $originId)
{
    $pdo = conexionBDD();

    // Insertion de l'email dans la table subscribers
    $sql = 'INSERT INTO subscribers
            (email, first_name, name, origine_id, created_on) 
            VALUES (?,?,?,?, NOW())';

    $query = $pdo->prepare($sql);
    $query->execute([$email, $first_name, $name, $originId]);
}
