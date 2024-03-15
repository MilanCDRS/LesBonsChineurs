<?php
class Conversation{
    // variables
    protected $_idConv;
    protected Item $_item;    
    protected User $_userAcheteur;
    protected $_messages;               // liste de messages


    // Constructor
    public function __construct($idConv, Item $item, User $userAcheteur){
        $this->idConv = $idConv;
        $this->item = $item;
        $this->_userAcheteur = $userAcheteur;
        $this->_messages = array();
    }

    // Getters 
    public function __get($propriete) {
        switch ($propriete) {
            case "idConv" : return $this->_idConv;
            case "item" : return $this->_item;
            case "userAcheteur" : return $this->_userAcheteur;
            case "message" : return $this->_message;
        }
    }

    // Setters
    public function __set($propriete, $value) {
        switch ($propriete) {
            case "idConv" : $this->_idConv = $value; break;
            case "item" : $this->_item = $value; break;
            case "userAcheteur" : $this->_userAcheteur = $value; break;
            case "message" : $this->_message = $value; break;
        }
    }

    public function addMessage(Message $mess){
        array_push($this->messages, $mess);
    }
}
?>