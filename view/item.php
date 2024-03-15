<div id="itemView">
    
    <img class=imgItem src="ressources/images/icon/croix.png">
    <a class=nom><?php echo $item->nom;?></a>
    <a class=nom><?php echo $item->sousCategorie->libelleSousCat;?></a>
    <a class=nom><?php echo $item->description;?></a>
    <a class=prix><?php echo $item->prix;?>€</a><br>
    <div class="vendeur">
        <a class=nom><?php echo $item->vendeur->pseudo; ?></a> 
    </div>
    <a class=date><?php echo date('d/m/Y', strtotime($item->dateMiseEnLigne));?></a>
</div>


