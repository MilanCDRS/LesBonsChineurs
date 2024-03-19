<div id=communication>
    <div id="conversations">
        <H3>↓ CONVERSATIONS ↓</H3>

        <?php 
        if(is_array($conversations)){
            foreach($conversations as $conv){            
                echo "<a id='".$conv->idConv."' href='./?conv=$conv->idConv' class=conv >";
                if($conv->userAcheteur == $_SESSION['user'])    echo $conv->item->vendeur->pseudo;
                else                                        echo $conv->userAcheteur->pseudo;
                echo " | ".$conv->item->nom."</a>";
            } 
        }?> 

    </div>

    <div id="messages">
        <div id="mess">
            <?php 
            if(is_array($messages)){
                foreach($messages as $mess){
                    if($mess->envoyeur == $_SESSION['user'])    echo "<a class=sent>";
                    else echo "<a class=received>";
                    echo $mess->message;
                    echo "</a>";
                } 
            }?> 
        </div>

    <form method=POST id=sendMessage autocomplete="off">
        <img src="ressources/images/icon/smiley.png">
        <input id=TxtMess type="text" name="message" required>
        <button type="submit" name="sendMess">Envoyer</button>
    </form>

    </div>
</div>

<script>
    // Positionnez la barre de défilement en bas de la <div>
    var messagesContainer = document.getElementById("mess");    
    messagesContainer.scrollTop = messagesContainer.scrollHeight;  
    
    function actualiserPage() {
        location.reload(true);
    }

    // Actualiser la page toutes les 10 secondes
    var actualisationAutomatique = setInterval(actualiserPage, 10000);

    // Désactiver l'actualisation lorsque l'utilisateur commence à écrire
    document.getElementById('TxtMess').addEventListener('input', function() {
        clearInterval(actualisationAutomatique);
        actualisationAutomatique = setInterval(actualiserPage, 300000); // Actualiser la page toutes les 5 minutes
    });
</script>