<?php
class Item{
    // variables
    protected $_ref;
    protected User $_vendeur;
    protected $_nom;
    protected $_prix;
    protected $_description;    
    protected sousCategorie $_sousCategorie;
    protected $_dateMiseEnLigne;
    protected $_image;

    // Constructor
    public function __construct($ref, User $vendeur, $nom, $prix, $description, sousCategorie $sousCategorie, $dateMiseEnLigne){
        $this->_ref = $ref;
        $this->_nom = strCheck($nom);
        $this->_prix = round(abs($prix));
        $this->_description = strCheck($description);
        $this->_vendeur = $vendeur;
        $this->_sousCategorie = $sousCategorie;
        $this->_dateMiseEnLigne = $dateMiseEnLigne;
        $this->_image = null;
        $this->getImg();
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "ref" : return $this->_ref;
            case "nom" : return $this->_nom;
            case "prix" : return $this->_prix;
            case "description" : return $this->_description;
            case "vendeur" : return $this->_vendeur;
            case "sousCategorie" : return $this->_sousCategorie;
            case "dateMiseEnLigne" : return $this->_dateMiseEnLigne;
            case "image" : return $this->_image;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "ref" : $this->_ref = $value; break;
            case "nom" : $this->_nom = strCheck($value); break;
            case "prix" : $this->_prix = $value; break;
            case "description" : $this->_description = strCheck($value); break;
            case "vendeur" : $this->_vendeur = $value; break;
            case "sousCategorie" : $this->_sousCategorie = $value; break;
            case "dateMiseEnLigne" : $this->_dateMiseEnLigne = $value; break;
            case "image" : $this->_image = $value; break;
        }
    }

    // FUNCTIONS 
    private function getImg(){
        $scandir = scandir("./ressources/images/items/");
        foreach($scandir as $fichier){
            if(pathinfo($fichier, PATHINFO_FILENAME) == $this->ref)
                $this->_image = $fichier;
        }
    }
    
}
?>