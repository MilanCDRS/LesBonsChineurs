<form method=post>
    <h2><?php echo $libcat;?></h2>

    <label for="categorie">Catégorie :</label>
    <?php 
        if($liste[0] instanceof Categorie) echo "<select name=categorie required>";
        else echo "<select name=sousCategorie required>";
        
            foreach($liste as $l){
                if($l instanceof Categorie)
                    echo "<option value=$l->codeCat>$l->libelleCat</option>";
                    if($l instanceof sousCategorie)
                    echo "<option value=$l->codeSousCat>$l->libelleSousCat</option>";
            }
    ?>
    </select>
    <button type=submit>Continuer</button>
    
</form>