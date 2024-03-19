<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

if(!isLoggedOn()){
    header("location: ./?action=menu");
}
$messErr = "";

//CODE 
if(isset($_GET["i"])){
    $item = GetItemByRef($_GET["i"]);
}

if(isset($_POST['contacter'])){
    $item = GetItemByRef($_POST['contacter']);

    if(!GetConversationByUserAndItem($item, $_SESSION['user'])){
        createConversation($item);
    }

    $conv = GetConversationByUserAndItem($item, $_SESSION['user']);

    $convId = $conv->idConv;
    header("location: ./?conv=$convId");
}

//RENDER
include_once "$racine/view/item.php";
include_once "$racine/view/footer.php";