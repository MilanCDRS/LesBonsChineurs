CATEGORIES
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>libellé</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cats as $c): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $c->codeCat; ?></td>
                    <td><input type=text name=libelleCat placeholder='<?php echo htmlentities($c->libelleCat); ?>'></td>   
                    <td><button name=updateCat value=<?php echo $c->codeCat; ?>>Modifier</button></td>         
                    <td><button name=deleteCat value=<?php echo $c->codeCat; ?>>Supprimer</button></td>      
                </form>             
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
SOUS CATEGORIES
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Catégorie mère</th>
            <th>libellé</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($souscats as $c): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $c->codeSousCat; ?></td>
                    <td><input type=text name=libelleCat placeholder=<?php echo $c->categorie->libelleCat; ?>></td>
                    <td><input type=text name=libelleSousCat placeholder=<?php echo $c->libelleSousCat; ?>></td>      
                    <td><button name=updateSousCat value=<?php echo $c->codeSousCat; ?>>Modifier</button></td>         
                    <td><button name=deleteSousCat value=<?php echo $c->codeSousCat; ?>>Supprimer</button></td>     
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>