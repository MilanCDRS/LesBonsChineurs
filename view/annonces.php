<div id="items">

    <div id=ajouterItem class="item">
        <a class=nom>Ajoutez une annonce !</a> 
        <img class=imgItem src="ressources/images/icon/croix.png">
    </div>

    <?php 
    if($items !=null){
    foreach($items as $i){?>

    <div class="item" id="<?php echo $i->ref; ?>">
        <div class="vendeur">
            <a class=nom><?php echo $i->vendeur->pseudo; ?></a> 
        </div>
        <img class=imgItem src="ressources/images/icon/croix.png">
        <a class=nom><?php echo $i->nom;?></a>
        <a class=prix><?php echo $i->prix;?>€</a><br>
        <a class=datr><?php echo date('d/m/Y', strtotime($i->dateMiseEnLigne));?></a>
    </div>

<?php }}?>
</div>

<script>
    const ajouter = document.getElementById("ajouterItem");
    ajouter.addEventListener('click', e=> { window.location.href = "./?action=add";})

    const items = document.querySelectorAll(".item"); // recupere toutes les items 
    items.forEach(it => 

    it.addEventListener("dblclick", e => { // double click
        window.location.href = "?UpdateItem="+it.id; //variable s dans url
    })	   

)
</script>