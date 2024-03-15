<div class="loginform">   

    <form method="post">
        <h2>Connexion</h2>  
        <a><?php echo $messErr;?></a>
        
        <label for="mail">E-mail:</label>
        <input type="mail" id="mail" name="mail" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login">Se connecter</button>
        <a href="./?action=register">Pas encore de compte? Inscrivez-vous ici !</a>
    </form>
</div>