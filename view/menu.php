<form id="filtres" method=post>
    <h2>Affinez vos recherches</h2>
    <label for="categorie">Catégorie :</label>
    <select name="categories">
        <option class=cats value='cat_All'>-- Toutes les Catégories --</option>
        <?php 
            foreach(GetCats() as $c){
                echo "<option class=cats value='cat_$c->codeCat'>$c->libelleCat</option>";
                echo "<optgroup label='$c->libelleCat'>";
                foreach(GetSousCatsByCat($c) as $sC){
                    echo "<option value='sousCat_$sC->codeSousCat'>↳ $sC->libelleSousCat</option>";
                }
                echo "</optgroup>";
            }
        ?>
    </select>

    <label for="prixMin">Prix Min:</label>
    <input type="number" min=0 name="prixMin">

    <label for="prixMax">Prix Max:</label>
    <input type="number" min=0 name="prixMax">

    <button type=submit name=recherche>Rechercher</button>

</form>

<div id="items">
<?php 
if($items !=null){
foreach($items as $i){?>

<div class="item" id=item>
    <div class="vendeur">
        <a class=nom><?php echo $i->vendeur->pseudo; ?></a> 
    </div>
    <?php
        if($i->image)
            echo "<img class=imgItem src='ressources/images/items/$i->image'>";
        else
            echo '<img class=imgItem src="ressources/images/icon/croix.png">';
    ?>
    <a class=nom><?php echo $i->nom;?></a>
    <a class=prix><?php echo $i->prix;?>€</a><br>
    <a class=date><?php echo date('d/m/Y', strtotime($i->dateMiseEnLigne));?></a>
    <a class=link href="./?item=<?php echo $i->ref;?>">Plus d'information</a>
</div>

<?php }} ?>
</div>

<script>
</script>