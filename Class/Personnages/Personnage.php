<?php

Class Personnage{

    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;
    private $_nombreCoup;
    private $_dateCoup;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;
    const PERSONNAGE_LIMIT_COUP=4;

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
    public function nombreCoup() { return $this->_nombreCoup; }
    public function dateCoup() { return $this->_dateCoup; }


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

    public function setNombreCoup($nombreCoup){
        $this->_nombreCoup = (int) $nombreCoup;
    }

    public function setDateCoup($dateCoup){
        $this->_dateCoup = $dateCoup;
    }
    public function nomValide(){

        return !empty($this->_nom);

    }
    public function frapper(Personnage $perso){

        $today = date('Y-m-d');
        if ($this->_dateCoup === $today && $this->_nombreCoup >= 3) {
            return self::PERSONNAGE_LIMIT_COUP;
        }
        $this->_nombreCoup++;
        $this->_dateCoup = $today;
        
        if($perso->id() == $this->_id)
            return self::CEST_MOI;

        $exp=$this->experience()+10;
        $this->setExperience($exp);

        if ($this->_experience >= 100) {
            $this->_niveau++;
            $this->_forcePerso+=10;
            $this->_experience = 0; 
        }

        return $perso->recevoirDegats($this->forcePerso());
    }

    public function recevoirDegats(int $force){
        
        if($force<25)
            $this->_degats+=5;
        elseif(($force>25)&&($force<50))
            $this->_degats+=10;
        else
            $this->_degats+=25;

        if($this->_degats>100)
            return self::PERSONNAGE_TUE;   
        return self::PERSONNAGE_FRAPPE;
    }
}