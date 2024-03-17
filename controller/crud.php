<?php 
//PRESET
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/model/crud.php";
include_once "$racine/view/header.php";

if(!isLoggedOnAsAdmin()){
    header("location: ./?action=menu");
}

$messErr = "";
//CODE 

include_once "$racine/view/CRUD/menu.php";

$cats = GetCats();
$souscats = GetSousCats();

if($action == 'crudItems'){
    $items = GetItems();
    include_once "$racine/view/CRUD/items.php";
}
elseif($action == 'crudCats'){
    include_once "$racine/view/CRUD/categories.php";
}
elseif($action == 'crudUsers'){
    $users= GetUsers();
    include_once "$racine/view/CRUD/users.php";
}
else{
    $items = GetItems();
    include_once "$racine/view/CRUD/items.php";
}

// ITEMS
if(isset($_POST['updateItem']))
{
    $ref = $_POST['updateItem'];
    $item = GetItemByRef($ref);
    $item->nom = $_POST['nom'] ? $_POST['nom'] : $item->nom;
    $item->prix = $_POST['prix'] ? $_POST['prix'] : $item->prix;
    $item->description = $_POST['description'] ? $_POST['description'] : $item->description;
    $item->sousCategorie = GetSousCatByCode($_POST['categories']) ? GetSousCatByCode($_POST['categories']) : $item->sousCategorie;
    UpdateItem($item);
}
if(isset($_POST['deleteItem']))
{
    $ref = $_POST['deleteItem'];
    DeleteItem(GetItemByRef($ref));
}

// CATREGORIES
if(isset($_POST['updateCat']))
{
    $code = $_POST['updateCat'];
    $cat = GetCatByCode($code);
    $cat->libelleCat = $_POST['libelleCat'] ? $_POST['libelleCat'] : $cat->libelleCat;
    UpdateCat($cat);
}
if(isset($_POST['deleteCat']))
{
    $code = $_POST['deleteCat'];
    $cat = GetCatByCode($code);
    DeleteCat($cat);
}

//SousCategories
if(isset($_POST['updateSousCat']))
{
    $code = $_POST['updateSousCat'];
    $souscat = GetSousCatByCode($code);
    $souscat->libelleSousCat = $_POST['libelleSousCat'] ? $_POST['libelleSousCat'] : $souscat->libelleSousCat;
    $souscat->categorie = GetCatByCode($_POST['categories']) ? GetCatByCode($_POST['categories']) : $souscat->categorie;
    UpdateSousCat($souscat);
}
if(isset($_POST['deleteSousCat']))
{
    $code = $_POST['deleteSousCat'];
    $souscat = GetSousCatByCode($code);
    DeleteSousCat($souscat);
}

//USER
if(isset($_POST['updateUser']))
{
    $ident = $_POST['updateUser'];
    $user = GetUserById($ident);
    $user->pseudo = $_POST['pseudo'] ? $_POST['pseudo'] : $user->pseudo;
    $user->mail = $_POST['mail'] ? $_POST['mail'] : $user->mail;
    $user->mdp = $_POST['mdp'] ? hash('md5',$_POST['mdp']) : $user->mdp;
    UpdateUser($user);
} 
if(isset($_POST['deleteUser']))
{
    $ident = $_POST['updateUser'];
    DeleteUser(GetUserById($ident));
} 

//RENDER
include_once "$racine/view/footer.php";