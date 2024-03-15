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
if(isset($_POST['register'])){
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $mail2 = $_POST['mail2'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if($mail != null && $mail2 != null && $password != null && $password2 != null && $pseudo != null){
        if($mail == $mail2){
            if($password == $password2){
                if(PSW_Check($password)){
                    if(GetUserByMail($mail)==null){
                        InsertUser(new User(0000000000, $pseudo, $mail, hash('md5', $password), date("dd/mm/yyyy")));
                        echo '<div id=PopUp><a href="./?action=login">Inscription Réussie !</a><a id=ok href="./?action=login">Ok</a> </div>';
                    }else $messErr ="Cet E-mail est déjà enregistré, connectez-vous.";
                }else $messErr = "Le mot de passe doit contenir au moins 12 caractères, une majuscule, un chiffre, un caractére Spécial.";
            }else $messErr ="Les mots de passe ne sont pas identiques.";
        }else $messErr ="Les mails ne sont pas identiques.";
    }else $messErr ="Veuillez remplir tous les champs.";    
}

function PSW_Check($password){
    $valide = false;
    $len=false;
    $chiffre = false;
    $maj=false;
    $caracSpe=false;    

    if(strlen($password)>=12){
        $len = true;
    }  

    for($i = 0; $i < strlen($password); $i++){
        if(ctype_digit($password[$i]))
            $chiffre=true;
        if(ctype_upper($password[$i]))
            $maj=true;
        if(ctype_punct($password[$i]))
            $caracSpe=true;
    }

    if($len && $chiffre && $maj && $caracSpe)
        $valide = true;

    return $valide;
}

//RENDER
include_once "$racine/view/register.php";
include_once "$racine/view/footer.php";