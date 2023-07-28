<?php

require_once('./Class/Personnages/Personnage.php');
require_once('./Class/Personnages/PersonnagesManager.php');

$perso = new Personnage([
    'nom' =>'Modou',
    'forcePerso' => 5,
    'degats' => 0,
    'niveau' => 1,
    'experience' => 0
    ]);
    try {
        $db = new PDO('mysql:host=localhost;dbname=open', 'root', 'MdialloC19@');
        $manager = new PersonnagesManager($db);
       
        $manager->add($perso);

        
    
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
        echo "Informations d'erreur : " . print_r($q->errorInfo(), true);
    }
    