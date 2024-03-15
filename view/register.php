<div class="loginform">
    

    <form method="post">
        <h2>Inscription</h2>   
        
        <a><?php echo $messErr;?></a>

        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required>

        <label for="mail">E-mail :</label>
        <input type="mail" name="mail" required>

        <label for="mail">Confirmation E-mail :</label>
        <input type="mail" name="mail2" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>

        <label for="password">Confirmation :</label>
        <input type="password" name="password2" required>

        <button type="submit" name="register">S'inscrire</button>
        <a href="./?action=login">Déjà inscrit? Contectez-vous ici !</a>
    </form>
</div>