<?php
class User{
    // variables
    protected $_ident;
    protected $_pseudo;
    protected $_mail;
    protected $_mdp;
    protected $_dateInscr;

    // Constructor
    public function __construct($ident, $pseudo, $mail, $mdp, $dateInscr){
        $this->_ident = $ident;
        $this->_pseudo = strCheck($pseudo);
        $this->_mail = $mail;
        $this->_mdp = $mdp;
        $this->_dateInscr = $dateInscr;
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "ident" : return $this->_ident;
            case "pseudo" : return $this->_pseudo;
            case "mail" : return $this->_mail;
            case "mdp" : return $this->_mdp;
            case "dateInscr" : return $this->_dateInscr;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "ident" : $this->_ident = $value; break;
            case "pseudo" : $this->_pseudo = strCheck($value); break;
            case "mail" : $this->_mail = $value; break;
            case "mdp" : $this->_mdp = $value; break;
            case "dateInscr" : $this->_dateInscr = $value; break;
        }
    }
}
?>