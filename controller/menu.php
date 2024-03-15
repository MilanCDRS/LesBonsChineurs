<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/view/header.php";

//CODE 
$item = "";

/*
$items = GetItems();

if(isset($_POST['categories']) && $_POST['categories'] != "cat_All"){
    $cat = explode("_", $_POST['categories']);
    if($cat[0] == "cat"){
        $categ = GetCatByCode($cat[1]);
    }
    if($cat[0] == "sousCat"){
        $categ = GetSousCatByCode($cat[1]);
    }
}
if(isset($_POST['prixMin'])){
    var_dump($_POST['prixMin']);
}
*/



if(isset($_POST['recherche'])){
    $prixMin = ($_POST['prixMin']) ? $_POST['prixMin'] : "0"; 
    $prixMax = ($_POST['prixMax']) ? $_POST['prixMax'] : "90000"; 
    $cat = explode("_", $_POST['categories']);
    if($cat[1] == "All"){
        $cat = null;
    }
    else if($cat[0] == "sousCat"){
        $cat = GetSousCatByCode($cat[1]);
    }
    else if($cat[0] == "cat"){
        $cat = GetCatByCode($cat[1]);
    }
    
    $items = GetItemsByFiltres($cat, (int)$prixMin, (int)$prixMax);
    

}else $items = GetItems();

//RENDER
include_once "$racine/view/menu.php";
include_once "$racine/view/footer.php";