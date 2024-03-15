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
        <?php foreach ($items as $item): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $item->ref; ?></td>
                    <td><?php echo $item->vendeur->pseudo; ?></td>
                    <td><input type=text name=nom placeholder='<?php echo $item->nom; ?>'></td>
                    <td><input type=text name=prix placeholder=<?php echo $item->prix; ?>></td>
                    <td><input type=text name=description placeholder="<?php echo htmlentities($item->description); ?>"></td>
                    <td><input type=text name=libellesouscat placeholder='<?php echo htmlentities($item->sousCategorie->libelleSousCat); ?>'></td>
                    <td><?php echo $item->dateMiseEnLigne; ?></td>
                    <td><button name=updateItem value=<?php echo $item->ref; ?>>Modifier</button></td>         
                    <td><button name=deleteItem value=<?php echo $item->ref; ?>>Supprimer</button></td>     
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
