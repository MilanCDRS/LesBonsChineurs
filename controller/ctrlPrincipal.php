<?php 
//HTACCES
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

//INCLUDES 
//classes
include_once "$racine/classes/1_FonctionsGenerales.php";
include_once "$racine/classes/User.php";
include_once "$racine/classes/Categorie.php";
include_once "$racine/classes/sousCategorie.php";
include_once "$racine/classes/Item.php";
include_once "$racine/classes/Message.php";
include_once "$racine/classes/Conversation.php";
//model
include_once "$racine/model/cnxBDD.php";
include_once "$racine/model/model.php";
include_once "$racine/model/userBDD.php";

// VARIABLES GLOBALES
$titre = "LBC";
$userConnected = null;

//CTRL
function ctrlPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "menu.php";
    $lesActions["item"] = "item.php";
    $lesActions["profil"] = "profil.php";
    $lesActions["login"] = "login.php";
    $lesActions["register"] = "register.php";
    $lesActions["messages"] = "conversations.php";
    $lesActions["add"] = "addItem.php";
    $lesActions["annonces"] = "annonces.php";
    $lesActions["crud"] = "crud.php";
    $lesActions["crudItems"] = "crud.php";
    $lesActions["crudCats"] = "crud.php";
    $lesActions["crudUsers"] = "crud.php";
    $lesActions["404"] = "404.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}
