<?php
// require_once('./Class/Personnages/Personnage.php');
// require_once('./Class/Personnages/PersonnagesManager.php');



    function chargerClasse($classe){

        require_once('./Class/Personnages/'.$classe.'.php');

    }
    spl_autoload_register('chargerClasse');

    session_start();
    // var_dump($_GET['frapper']);
// $perso = new Personnage([
//     'nom' =>'Modou',
//     'forcePerso' => 100,
//     'degats' => 0,
//     'niveau' => 1,
//     'experience' => 0
//     ]);
    if (isset($_GET['deconnexion']))
        {
            session_destroy();
            header('Location: .');
            exit();
        }
    if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
        {
            $perso = $_SESSION['perso'];
        }


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
    }elseif($_GET['frapper']){
        if (!isset($perso)){

            $message = 'Merci de créer un personnage ou de vous identifier.';
        }else{
            if(!$manager->exist((int)$_GET['frapper'])){

                $message='Le personnage à frapper n\'existe ';
            }else{

                $persoAFrapper=$manager->get((int)$_GET['frapper']);
                
                $retour=$perso->frapper($persoAFrapper);
                var_dump($retour);
                switch ($retour) {
                    case Personnage::CEST_MOI:
                        echo 'Mais... pourquoi voulez-vous vous frapper ???';
                        break;
                    case Personnage::PERSONNAGE_FRAPPE:
                        $message = 'Le personnage a bien été frappé !';
                        $manager->update($perso);
                        $manager->update($persoAFrapper);
                        break;
                    case Personnage::PERSONNAGE_TUE:
                        $message = 'Le personnage a été  tué !';
                        $manager->update($perso);
                        $manager->delete($persoAFrapper);
                        break;
                }
            }
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
   
    if (isset($perso)) {
    ?>
        <p><a href="?deconnexion=1">Déconnexion</a></p>
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
            <?php
                $persos=$manager->getList();

                if(empty($perso)){
                    echo 'Personne à frapper';
                }else {
                    foreach($persos as $unPerso){
                        echo '<a href="?frapper=', $unPerso->id(), '">',htmlspecialchars($unPerso->nom()), '
                        </a> (dégâts : ', $unPerso->degats(), ')<br />';
                    }
                }
            ?>
        </p>
        </fieldset>
    <?php
    } else{

    ?>
        <form action="#" method="post">
            <p>Nom : <input type="text" name="nom" maxlength="50" />
            <input type="submit" value="Créer ce personnage" name="creer" />
            <input type="submit" value="Utiliser ce personnage" name="utiliser" />
            </p>
        </form>
   
    <fieldset>
    <legend>Choisir un personnage</legend>
    <p> 
        <?php
            $persos=$manager->getList();

            if(!empty($persos)){
                
                foreach($persos as $unPerso){
                    echo htmlspecialchars($unPerso->nom()), '
                    </a> (dégâts : ', $unPerso->degats(), ')<br />';
                }
            }
        ?>
    </p>
    </fieldset>
    <?php
    }
    ?>
    </body>
    </html>
    <?php
    if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
    {
        $_SESSION['perso'] = $perso;
    }


    