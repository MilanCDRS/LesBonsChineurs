<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=refresh http-equiv="refresh" content="600"> <!-- Actualiser toutes les 10 minutes --> 
        <title>LBC</title>
        <style type="text/css">
            @import url("css/style.css");   
            @import url("css/items.css");            
            @import url("css/login.css"); 
            @import url("css/conversations.css");   
            @import url("css/crud.css");
        </style>
    </head>
    <body>
        <header>
            <div class="home">
                <img src="ressources/images/icon/home.png">
                <a href="./?action=menu">Les Bons Chineurs</a>                
            </div>
            
            <span class="left">

                <?php 
                    if(isLoggedOnAsAdmin()){
                        echo "<div class='crud'>                
                            <img src='ressources/images/icon/parametres.png'>
                            <a href='./?action=crud'>Gestion du Site</a>
                        </div>";
                    }
                ?>

                <div class="add">                
                    <img src="ressources/images/icon/croix.png">
                    <a href="./?action=add">Déposer une annonce</a>
                </div>

                <div class="annonces">                
                    <img src="ressources/images/icon/annonces.png">
                    <a href="./?action=annonces">Mes Annonces</a>
                </div>

                <div class="mess">                
                    <img src="ressources/images/icon/message.png">
                    <a href="./?action=messages">Messages</a>
                </div>

                <div class="profil">                
                    <img src="ressources/images/icon/avatar.png">
                    <a href="./?action=profil">
                        <?php 
                        if(isLoggedOn())    echo $_SESSION['user']->pseudo;
                        else                echo "Se Connecter";
                        ?>
                    </a>
                </div>
            </span>

        </header>

        <div id=content>

<script>
    const home =  document.querySelector(".home");
    const crud =  document.querySelector(".crud");
    const add =  document.querySelector(".add");
    const mess =  document.querySelector(".mess");
    const profil =  document.querySelector(".profil");

    home.addEventListener('click', e=> { window.location.href = "./?action=menu";})
    crud.addEventListener('click', e=> { window.location.href = "./?action=crud";})
    add.addEventListener('click', e=> { window.location.href = "./?action=add";})
    mess.addEventListener('click', e=> { window.location.href = "./?action=message";})
    profil.addEventListener('click', e=> { window.location.href = "./?action=profil";})
</script>

   