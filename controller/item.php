<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

if(isLoggedOn()){
    header("location: ./?action=menu");
}

$messErr = "";

//CODE 
if(isset($_GET["item"])){
    $item = GetItemByRef($_GET["item"]);
}

//RENDER
include_once "$racine/view/item.php";
include_once "$racine/view/footer.php";