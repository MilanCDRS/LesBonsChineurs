<table>
    <thead>
        <tr>
            <th>Référence</th>
            <th>Vendeur</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Sous-catégorie</th>
            <th>Date Mise En Ligne</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form method=POST>
                <td></td>
                <td>
                    <select name="user">
                    <?php foreach(GetUsers() as $u){
                        echo "<option value='$u->ident'>$u->pseudo</option>";
                    }?>
                </td>
                <td><input type=text name=nom placeholder='Ajouter un Objet'></td>
                <td><input type=text name=prix placeholder="prix"></td>
                <td><input type=text name=description placeholder="description"></td>
                <td>
                    <select name="categories">
                    <?php 
                        foreach($souscats as $cat){
                            echo "<option class=cats value='$cat->codeSousCat'>$cat->libelleSousCat</option>";
                        }
                    ?>
                    </select>
                </td>
                <td></td>
                <td><button name=addItem>Ajouter</button></td> 
                <td></td>
            </form>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $item->ref; ?></td>
                    <td><?php echo $item->vendeur->pseudo; ?></td>
                    <td><input type=text name=nom placeholder='<?php echo $item->nom; ?>'></td>
                    <td><input type=text name=prix placeholder=<?php echo $item->prix; ?>></td>
                    <td><input type=text name=description placeholder="<?php echo htmlentities($item->description); ?>"></td>
                    <td>
                        <select name="categories">
                        <?php 
                            foreach($souscats as $cat){
                                if($cat == $item->sousCategorie)
                                    echo "<option class=cats value='$cat->codeSousCat' selected>$cat->libelleSousCat</option>";
                                else
                                    echo "<option class=cats value='$cat->codeSousCat'>$cat->libelleSousCat</option>";
                            }
                        ?>
                        </select>
                    </td> 
                    <td><?php echo $item->dateMiseEnLigne; ?></td>
                    <td><button name=updateItem value=<?php echo $item->ref; ?>>Modifier</button></td>         
                    <td><button name=deleteItem value=<?php echo $item->ref; ?>>Supprimer</button></td>     
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
