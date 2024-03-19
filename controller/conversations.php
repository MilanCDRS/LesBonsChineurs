<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

if(!isLoggedOn()){
    header("location: ./?action=login");
}

//CODE
$conversations = GetConversationsUser($_SESSION['user']);
$messages = null;
$laConv = null;


if(isset($_GET['conv'])){
    
    $laConv = GetConversationById($_GET['conv']);
    $messages = GetMessagesConversation($laConv);

    
    if(isset($_POST['sendMess'])){
    $mess = $_POST['message'];
    $mess = str_replace("'", "''", $mess);
    $mess = str_replace("\\", "\\\\", $mess);
        if(trim($mess, " ") != null){        
            sendMessage($laConv, $mess, $_SESSION['user']);
            $messages = GetMessagesConversation($laConv);
            header("Refresh:0"); // evite la popup "Confirmer le nouvele nvoi du formulaire"
        }
    }
}

//RENDER
include_once "$racine/view/conversations.php";
include_once "$racine/view/footer.php";