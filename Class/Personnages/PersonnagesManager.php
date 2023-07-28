<?php
require_once('Personnage.php');

Class PersonnagesManager{

    private $_db;

    public function __construct($_db){

        $this->setDb($_db);

    }

    public function setDb(PDO $_db){
        
        $this->_db=$_db;
    }

    public function add(Personnage $perso){

        // var_dump($perso);
        $q=$this->_db->prepare('INSERT INTO personnages SET nom =:nom, 
        forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience');
        $q->bindValue(':nom',$perso->nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(),PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(),PDO::PARAM_INT);

        $q->execute();
        echo '<script>alert(\'ajouter avec succes\'</script>';


    }

    public function delete(Personnage $perso){
        $this->_db->exec('DELETE FROM personnages where id='.$perso->id());
    }
    public function get($id){

        $id = (int) $id;
        $q = $this->_db->query('SELECT id, nom, forcePerso, degats,
        niveau, experience FROM personnages WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Personnage($donnees);
    }

    public function getList(){

        $persos = array();
        $q = $this->_db->query('SELECT id, nom, forcePerso, degats,
        niveau, experience FROM personnages ORDER BY nom');

        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $perso []=new Personnage($donnees);
        }

        return $perso ;
    }

    public function update(Personnage $perso){

        $q=$this->_db->prepare('UPDATE personnages SET nom =:nom, 
        forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience');

        $q->bindValue(':nom', $perso->nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(),PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(),PDO::PARAM_INT);
        $q->execute();



    }
   

   
    
}