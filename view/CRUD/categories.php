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
        <tr>
            <form method=POST>
                <td></td>
                <td><input type=text name=libelleCat placeholder='Ajouter une Catégorie'></td>
                <td><button name=addCat>Ajouter</button></td> 
                <td></td>
            </form>
        </tr>
        <tr><td></td><td></td><td></td><td></td></tr>
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
        <tr>
            <form method=POST>
                <td></td>
                <td>
                    <select name="categories">
                    <?php 
                        foreach($cats as $cat){
                            echo "<option class=cats value='$cat->codeCat'>$cat->libelleCat</option>";
                        }
                    ?>
                    </select>
                </td>
                <td><input type=text name=libelleSousCat placeholder='Ajouter une Sous Catégorie'></td>
                <td><button name=addSousCat value=1>Ajouter</button></td> 
                <td></td>
            </form>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td></tr>
        <?php foreach ($souscats as $c): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $c->codeSousCat; ?></td>
                    <td>
                        <select name="categories">
                        <?php 
                            foreach($cats as $cat){
                                if($cat == $c->categorie)
                                    echo "<option class=cats value='$cat->codeCat' selected>$cat->libelleCat</option>";
                                else
                                    echo "<option class=cats value='$cat->codeCat'>$cat->libelleCat</option>";
                            }
                        ?>
                        </select>
                    </td>
                    <td><input type=text name=libelleSousCat placeholder='<?php echo $c->libelleSousCat; ?>'></td>      
                    <td><button name=updateSousCat value=<?php echo $c->codeSousCat; ?>>Modifier</button></td>         
                    <td><button name=deleteSousCat value=<?php echo $c->codeSousCat; ?>>Supprimer</button></td>     
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>