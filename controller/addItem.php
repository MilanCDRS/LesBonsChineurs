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


$libcat = " Choix Catégorie";
$liste = GetCats();
if(isset($_POST['categorie'])){
    $libcat = " Choix Sous Catégorie";
    $cat = GetCatByCode($_POST['categorie']);
    $liste = GetSousCatsByCat($cat);
    include_once "$racine/view/Additem/categorie.php";
}else if(isset($_POST['sousCategorie'])){    
    setcookie('sousCat', $_POST['sousCategorie']);
    include_once "$racine/view/Additem/addItem.php";
}
else{
    if(isset($_COOKIE['souscat']))
        include_once "$racine/view/Additem/addItem.php";
    else
        include_once "$racine/view/Additem/categorie.php";
}

if(isset($_POST['add'])){
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    

    $item = new Item(0000, $_SESSION['user'], $nom, $prix, $description, GetSousCatByCode($_COOKIE['sousCat']), '2020');
    AddItem($item);

    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) { 
        $item = GetLastItemUser($_SESSION['user']);
        $ref =  $item->ref;

        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $description = $_POST["description"];
        
        $targetDir = "ressources/images/items/"; // Dossier de destination
        $originalFileName = basename($_FILES["image"]["name"]);

        $newFileName = $ref . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
        $newFilePath = $targetDir . $newFileName;

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $newFilePath)) {               
            } 
        } 
    }


    setcookie('sousCat', '', time()-30);
    echo '<div id=PopUp><a href="./?action=menu">Votre article a bien été mis en vente !</a><a id=ok href="./?action=menu">Ok</a> </div>';
}

//RENDER
include_once "$racine/view/footer.php";