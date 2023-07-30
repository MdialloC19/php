<?php
require_once('./Class/Personnages/Personnage.php');
require_once('./Class/Personnages/PersonnagesManager.php');



function chargerClasse($classe){

    require_once('./Class/Personnages/'.$classe.'.php');

}
spl_autoload_register('chargerClasse');


// $perso = new Personnage([
//     'nom' =>'Modou',
//     'forcePerso' => 100,
//     'degats' => 0,
//     'niveau' => 1,
//     'experience' => 0
//     ]);
    try {
        $db = new PDO('mysql:host=localhost;dbname=open', 'modou', 'Passer2023');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
       
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
        echo "Informations d'erreur : " . print_r($q->errorInfo(), true);
    }
    $manager = new PersonnagesManager($db);

    if(isset($_POST['creer'])&& isset($_POST['nom'])){

        $perso=new Personnage([
            'nom' =>$_POST['nom'],
            'forcePerso' => 100,
            'degats' => 0,
            'niveau' => 1,
            'experience' => 0
        ]);

        if(!$perso->nomValide()){
            $message = 'Le nom choisi est invalide.';
            unset($perso);
        }elseif($manager->exist($perso->nom())){
            $message='Le personnage existe déja, veuillez saisir un autre';
            unset($perso);

        }else{
            $manager->add($perso);
        }
    }elseif(isset($_POST['utiliser'])&& isset($_POST['nom'])){
        
        if($manager->exist($_POST['nom'])){
            $perso=$manager->get($_POST['nom']);
            
        }else{
            $message='personnage n\'existe pas ';
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>CSS Positioning</title>
      <style>
       
      </style>
    </head>
    <body>
        
        <p>Nombre de Personnages crées : <?php echo $manager->count() ?> </p>
    <?php
    if(isset($message))
        echo '<p>'.$message.'</p>';
   
    if (isset($perso)) 
    
    ?>
        <fieldset>
            <legend>Mes informations</legend>
            <p>
            Nom : <?php echo htmlspecialchars($perso->nom()); ?><br />
            Dégâts : <?php echo $perso->degats(); ?>
            </p>
        </fieldset>
    <fieldset>
    <legend>Qui frapper ?</legend>
    <p> 
    <form action="#" method="post">
        <p>Nom : <input type="text" name="nom" maxlength="50" />
        <input type="submit" value="Créer ce personnage" name="creer" />
        <input type="submit" value="Utiliser ce personnage" name="utiliser" />
        </p>
    </form>
   
    </body>
    </html>


    