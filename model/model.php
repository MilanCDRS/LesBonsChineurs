<?php 
//
//      ITEMS
//
function GetItemByRef($ref){
    $item = "";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetItemByRef($ref);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $vendeur = GetUserById($res['identVendeur']);
            $sousCat = GetSousCatByCode($res['codeSousCat']);
            $item = new Item($res['ref'], $vendeur, $res['nom'], $res['prix'], $res['description'], $sousCat, $res['dateMiseEnLigne']);

            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $item;
}

function GetItemsByUser(User $user){
    $items = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetItemsByUser($user->ident);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $vendeur = GetUserById($res['identVendeur']);
            $sousCat = GetSousCatByCode($res['codeSousCat']);
            $item = new Item($res['ref'], $vendeur, $res['nom'], $res['prix'], $res['description'], $sousCat, $res['dateMiseEnLigne']);
            array_push($items, $item);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $items;
}

function GetLastItemUser(User $user){
    $item = "";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetLastItemUser($user->ident);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $vendeur = GetUserById($res['identVendeur']);
            $sousCat = GetSousCatByCode($res['codeSousCat']);
            $item = new Item($res['ref'], $vendeur, $res['nom'], $res['prix'], $res['description'], $sousCat, $res['dateMiseEnLigne']);
            
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $item;
}


function GetItems(){
    $items = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetItems();");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $vendeur = GetUserById($res['identVendeur']);
            $sousCat = GetSousCatByCode($res['codeSousCat']);
            $item = new Item($res['ref'], $vendeur, $res['nom'], $res['prix'], $res['description'], $sousCat, $res['dateMiseEnLigne']);
            array_push($items, $item);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $items;
}

function AddItem(Item $item){
    $vendeur = $item->vendeur->ident;
    $nom = $item->nom;
    $prix = $item->prix;
    $description = $item->description; 
    $sousCategorie = $item->sousCategorie->codeSousCat;
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call addItem($vendeur, '$nom', $prix, '$description', $sousCategorie);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function DeleteItem(Item $item){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call deleteItem($item->ref);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function UpdateItem(Item $item){
    $vendeur = $item->vendeur->ident;
    $nom = $item->nom;
    $prix = $item->prix;
    $description = $item->description; 
    $sousCategorie = $item->sousCategorie->codeSousCat;
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call updateItem($item->ref, '$nom', $prix, '$description', $sousCategorie);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function GetItemsByFiltres($Cat, int $prixMin, int $prixMax){
    $items = array();
    try{
        $cnx = connexionPDO();
        if($Cat instanceof Categorie){
            $req = $cnx->prepare("SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne 
                                    FROM Item inner join sousCategorie on item.codeSousCat = sousCategorie.code 
                                    inner Join Categorie on sousCategorie.codeCat = Categorie.code
                                    WHERE Categorie.code = $Cat->codeCat
                                    AND prix >= $prixMin 
                                    AND prix <= $prixMax;");
        }
        else if($Cat instanceof sousCategorie){
            $req = $cnx->prepare("SELECT ref, identVendeur, nom, prix, description, codeSousCat, dateMiseEnLigne 
                                FROM Item inner join sousCategorie on item.codeSousCat = sousCategorie.code 
                                WHERE sousCategorie.code = $Cat->codeSousCat
                                AND prix >= $prixMin 
                                AND prix <= $prixMax;");
        }
        else if($Cat === null){
            $req = $cnx->prepare("call GetItemsByRangePrix(:prixMin, :prixMax);");
        }
        $req->BindParam(':prixMin', $prixMin, PDO::PARAM_INT);
        $req->BindParam(':prixMax', $prixMax, PDO::PARAM_INT);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $vendeur = GetUserById($res['identVendeur']);
            $sousCat = GetSousCatByCode($res['codeSousCat']);
            $item = new Item($res['ref'], $vendeur, $res['nom'], $res['prix'], $res['description'], $sousCat, $res['dateMiseEnLigne']);
            array_push($items, $item);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $items;
}

//
//      USERS
//
function GetUserById($id){
    $user = "";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetUserById($id);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $user = new User($res['ident'], $res['pseudo'], $res['mail'], $res['mdp'], $res['date_inscription']);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $user;
}

function GetUserByMail($mail){
    $user = "";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetUserByMail('$mail');");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $user = new User($res['ident'], $res['pseudo'], $res['mail'], $res['mdp'], $res['date_inscription']);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $user;
}

function GetAdminIdent($id){
    $admin = false;
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetAdminIdent($id);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            if($res['id'] != null){
                $admin = true; 
            }
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }catch (Exception $e)
    { 
        $action = "404";
    }

    return $admin;
}


function InsertUser(User $user){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call InsertUser('$user->pseudo', '$user->mail', '$user->mdp');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function UpdateUser(User $user){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call updateUser($user->ident, '$user->pseudo', '$user->mail', '$user->mdp');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function DeleteUser(User $user){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call deleteUser($user->ident);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function GetUsers(){
    $users = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetUsers();");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $user = new User($res['ident'], $res['pseudo'], $res['mail'], $res['mdp'], $res['date_inscription']);
            array_push($users, $user);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }

    return $users;
}

//
//      CATEGORIES & SousCategories
//
function GetCats(){
    $Cats = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetCats();");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $cat = new Categorie($res['code'], $res['libelle']);
            array_push($Cats, $cat);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $Cats;
}

function GetCatByCode($code){
    $Cat="";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetCatByCode($code);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $Cat = new Categorie($res['code'], $res['libelle']);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $Cat;
}

function GetSousCats(){
    $Cats = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetSousCats();");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $cat = GetCatByCode($res['codeCat']);
            $sousCat = new sousCategorie($res['code'], $cat, $res['libelle']);
            array_push($Cats, $sousCat);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $Cats;
}

function GetSousCatsByCat(Categorie $cat){
    $Cats = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetSousCatsByCat($cat->codeCat);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $cat = GetCatByCode($res['codeCat']);
            $sousCat = new sousCategorie($res['code'], $cat, $res['libelle']);
            array_push($Cats, $sousCat);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $Cats;
}

function GetSousCatByCode($code){
    $sousCat="";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetSousCatByCode($code);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $cat = GetCatByCode($res['codeCat']);
            $sousCat = new sousCategorie($res['code'], $cat, $res['libelle']);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $sousCat;
}

function DeleteCat(Categorie $cat){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call DeleteCat($cat->codeCat);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function UpdateCat(Categorie $cat){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call UpdateCat($cat->codeCat, '$cat->libelleCat');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function DeleteSousCat(sousCategorie $souscat){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call DeleteSousCat($souscat->codeSousCat);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function UpdateSousCat(sousCategorie $souscat){
    $cat = $souscat->categorie->codeCat;
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call UpdateSousCat($souscat->codeSousCat, $cat ,'$souscat->libelleSousCat');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function AddCat(Categorie $cat){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call AddCat('$cat->libelleCat');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function AddSousCat(sousCategorie $souscat){
    $codeCat = $souscat->categorie->codeCat;
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call AddCat($codeCat, '$souscat->libelleSousCat');");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

//
//      Conversations et messages
//

function GetConversationsUser(User $user){
    $convs= array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetConversationsUser($user->ident);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $item = GetItemByRef($res['refItem']);
            $userAcheteur = GetUserById($res['identAcheteur']);
            $conv = new Conversation($res['idConv'], $item, $userAcheteur);
            array_push($convs, $conv);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $convs;
}

function GetConversationById(int $id){
    $conv= "";
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetConversationById($id);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $item = GetItemByRef($res['refItem']);
            $userAcheteur = GetUserById($res['identAcheteur']);
            $conv = new Conversation($res['idConv'], $item, $userAcheteur);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $conv;
}

function GetMessagesConversation(Conversation $conv){
    $mess=array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call GetMessagesConversation($conv->idConv);");
        $req->execute();

        $res = $req->fetch(PDO::FETCH_ASSOC);
        while ($res) {
            $envoyeur = GetUserById($res['identEnvoyeur']);
            $mes = new Message($res['codeMess'], $conv, $res['message'], $envoyeur, $res['dateMess']);
            array_push($mess, $mes);
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
    return $mess;
}

function sendMessage(Conversation $conv, $mess, User $user){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("call sendMessage($conv->idConv, '$mess', $user->ident);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}

function createConversation(Item $item){
    try{
        $identU = $_SESSION['user']->ident;
        $cnx = connexionPDO();
        $req = $cnx->prepare("call createConversation($item->ref, $identU);");
        $req->execute();
    }
    catch (Exception $e)
    { 
        $action = "404";
    }
}
?>