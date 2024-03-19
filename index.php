<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "getRacine.php";
include "$racine/controller/ctrlPrincipal.php";


if (isset($_GET["action"])){
    $action = $_GET["action"];
}else{    
    $action = "defaut";
}

if(isset($_GET['conv'])){
    $action="messages";
}

if(isset($_GET['i'])){
    $action="item";
}

if(isset($_GET['Updateitem'])){
    $action="annonces";
}

$fichier = ctrlPrincipal($action);
include "$racine/controller/$fichier";

?>