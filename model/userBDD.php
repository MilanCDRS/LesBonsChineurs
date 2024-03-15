<?php

function login(User $user){
    $salt = "LBC";
    if (!isset($_SESSION))
        session_start();        
    $_SESSION["user"] = $user;

}

function logout() {
    session_destroy();
}


function isLoggedOn() {
    $log = false;
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION["user"])) {
        $log = true;
    }
    return $log;
}

//Ditto IsloggedOn mais n'envoie true que si l'utilisateur est admin
function isLoggedOnAsAdmin() {
    $admin = false;
    try{
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION["user"])) {            
            if(GetAdminIdent($_SESSION["user"]->ident))
                $admin = true;            
        }
    }catch(PDOException $e){
        $action = "404";
    }

    return $admin;
}