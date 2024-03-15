<form id=profil method=post>
    <div>
        <img src="ressources/images/icon/avatar.png">
        <img class=modif src="ressources/images/icon/modifier.png">
    </div>
    <div>
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" readonly="readonly" placeholder=<?php echo $_SESSION['user']->pseudo;?>>
        <img class=modif src="ressources/images/icon/modifier.png">
    </div>
    <div>
        <label for="mail">E-mail :</label>
        <input type="mail" name="mail" readonly="readonly" placeholder=<?php echo $_SESSION['user']->mail;?>>
        <img class=modif src="ressources/images/icon/modifier.png">
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" readonly="readonly" placeholder="*****************">
        <img class=modif src="ressources/images/icon/modifier.png">
    </div>

    <div>
        <button type="submit" name="update">Enregistrer</button>
        <button type="submit" name="cancel">Annuler</button>
    </div>
</form>

<form id=logout method=post>
    <button type="submit" name="logout">Se déconnecter</button>
</form>


