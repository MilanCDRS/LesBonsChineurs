<?php
class sousCategorie{
    // variables
    protected $_codeSousCat;
    protected Categorie $_categorie;
    protected $_libelleSousCat;

    // Constructor
    public function __construct($codeSousCat, Categorie $categorie, $libelleSousCat){
        $this->_codeSousCat = $codeSousCat;
        $this->_categorie = $categorie;
        $this->_libelleSousCat = strCheck($libelleSousCat);
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "codeSousCat" : return $this->_codeSousCat;
            case "categorie" : return $this->_categorie;
            case "libelleSousCat" : return $this->_libelleSousCat;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "codeSousCat" : $this->_codeSousCat = $value; break;
            case "categorie" : $this->_categorie = $value; break;
            case "libelleSousCat" : $this->_libelleSousCat = strCheck($value); break;
        }
    }
}
?>