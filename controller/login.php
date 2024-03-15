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

if(isset($_POST['login'])){
    $connected = false;
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $userTest = GetUserByMail($mail);
    if($userTest != null){
        if($userTest->mdp == hash('md5', $password)){
            $connected = true;
        }       
    }
    if($connected){
        login($userTest);
        echo '<div id=PopUp><a href="./?action=menu">Connexion Réussie !</a><a id=ok href="./?action=menu">Ok</a> </div>';
    }
    if(!$connected){
        $messErr = "Erreur de connexion.\n Vérifiez vos identifiants et réessayez."; 
    }
}

//RENDER
include_once "$racine/view/login.php";
include_once "$racine/view/footer.php";