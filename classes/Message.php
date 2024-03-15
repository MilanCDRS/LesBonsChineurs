<?php
class Message{
    // variables    
    protected $_codeMess;
    protected Conversation $_Conv;
    protected $_message;
    protected User $_envoyeur;
    protected $_dateMess;

    // Constructor
    public function __construct( $codeMess, Conversation $Conv, $message, User $envoyeur, $dateMess){
        $this->_Conv = $Conv;
        $this->_codeMess = $codeMess;
        $this->_message = strCheck($message);
        $this->_envoyeur = $envoyeur;
        $this->_dateMess = $dateMess;
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "Conv" : return $this->Conv;
            case "codeMess" : return $this->_codeMess;            
            case "message" : return $this->_message;
            case "envoyeur" : return $this->_envoyeur;
            case "dateMess" : return $this->_dateMess;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "Conv" : $this->_Conv = $value; break;
            case "codeMess" : $this->_codeMess = $value; break;
            case "message" : $this->_message = strCheck($value); break;
            case "envoyeur" : $this->_envoyeur = $value; break;
            case "dateMess" : $this->_dateMess = $value; break;
        }
    }
}
?>