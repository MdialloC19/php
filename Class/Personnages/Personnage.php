<?php

Class Personnage{

    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;

    public function __construct(array $perso) {

        $this->hydrate($perso);
        
    }

    public function hydrate(array $donnees){

        foreach($donnees as $key=> $value){
            
            $method='set'.ucfirst($key);

            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }

    }

    public function id() { return $this->_id; }
    public function nom() { return $this->_nom; }
    public function forcePerso() { return $this->_forcePerso; }
    public function degats() { return $this->_degats; }
    public function niveau() { return $this->_niveau; }
    public function experience() { return $this->_experience; }


    public function setId($id){
        $this->_id = (int) $id;
    }

    public function setNom($nom){
    
        if (is_string($nom) && strlen($nom) <= 30){
            $this->_nom = $nom;
        }
    }

    public function setForcePerso($force){

        if(!is_int($force)){
            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if(!$force>100){
            trigger_error('La force d\'un personnage ne doit pas dépasser 100', E_USER_WARNING);
            return;
        }
        $this->_forcePerso=$force;
    }

    public function setDegats($degats){

        if(!is_int($degats)){
            trigger_error('La degats d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        $this->_degats=$degats;
    }

    public function setNiveau($niveau){
            $niveau = (int) $niveau;
        
        if ($niveau < 0){
            trigger_error('Le Niveau ne doit pas étre négatif', E_USER_WARNING);
            return ;
        }
        $this->_niveau = $niveau;
    }
    public function setExperience($exp){

        $exp= (int) $exp;

        if(!is_int($exp)){
            trigger_error('L\'experience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if(!$exp>100){
            trigger_error('L \' expérience d\'un personnage ne doit pas dépasser 100', E_USER_WARNING);
            return;
        }
        $this->_experience=$exp;
    }

    public function nomValide(){

        return !empty($this->_nom);

    }
    public function frapper(Personnage $perso){
        
        if($this==$perso)
            return self::CEST_MOI;
        return $perso->recevoirDegats();
    }

    public function recevoirDegats(){
        
        $this->_degats+=5;

        if($this->_degats>100)
            return self::PERSONNAGE_TUE;
            
        return self::PERSONNAGE_FRAPPE;

    }
}