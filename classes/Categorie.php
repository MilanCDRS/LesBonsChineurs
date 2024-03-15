<?php
class Categorie{
    // variables
    protected $_codeCat;
    protected $_libelleCat;

    // Constructor
    public function __construct($codeCat, $libelleCat){
        $this->_codeCat = $codeCat;
        $this->_libelleCat = strCheck($libelleCat);
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "codeCat" : return $this->_codeCat;
            case "libelleCat" : return $this->_libelleCat;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "codeCat" : $this->_codeCat = $value; break;
            case "libelleCat" : $this->_libelleCat = strCheck($value); break;
        }
    }
}
?>