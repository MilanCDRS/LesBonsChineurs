<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

if(!isLoggedOn()){
    header("location: ./?action=login");
}

// CODE
$items = GetItemsByUser($_SESSION['user']);
if(isset($_GET['UpdateItem'])){
    
}else include_once "$racine/view/annonces.php";

//RENDER

include_once "$racine/view/footer.php";