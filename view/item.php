<div id="itemView">
    
    <?php
        if($item->image)
            echo "<img class=imgItem src='ressources/images/items/$item->image'>";
        else
            echo '<img class=imgItem src="ressources/images/icon/vide.png">';
    ?>
    <a class=nom><?php echo $item->nom;?></a>
    <a class=nom><?php echo $item->sousCategorie->categorie->libelle;?></a>
    <a class=nom><?php echo $item->sousCategorie->libelleSousCat;?></a>
    <a class=nom><?php echo $item->description;?></a>
    <a class=prix><?php echo $item->prix;?>€</a><br>
    <div class="vendeur">
        <a class=nom><?php echo $item->vendeur->pseudo; ?></a> 
        <form method=POST><button name=contacter value="<?php echo $item->ref; ?>" class=link type=submit>Contacter</button></form>
    </div>
    <a class=date><?php echo date('d/m/Y', strtotime($item->dateMiseEnLigne));?></a>
</div>


