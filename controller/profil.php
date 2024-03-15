<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

if(!isLoggedOn()){
    header("location: ./?action=login");
}

$messErr = "";


//CODE 
if(isset($_POST['logout'])){
    logout();
    header('Location: index.php');
}

//RENDER
include_once "$racine/view/profil.php";
include_once "$racine/view/footer.php";