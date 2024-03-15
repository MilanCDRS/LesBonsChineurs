<table>
    <thead>
        <tr>
            <th>identifiant</th>
            <th>Pseudo</th>
            <th>Mail</th>
            <th>Mot de Passe</th>
            <th>Date Inscription</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <form method=POST>
                    <td><?php echo $u->ident; ?></input></td>
                    <td><input type=text name=pseudo placeholder=<?php echo $u->pseudo; ?>></td>
                    <td><input type=text name=mail placeholder=<?php echo $u->mail; ?>></td>
                    <td><input type=text name=mdp placeholder=<?php echo $u->mdp; ?>></td>
                    <td><?php echo $u->dateInscr; ?></td>
                    <td><button name=updateUser value=<?php echo $u->ident; ?>>Modifier</button></td>         
                    <td><button name=deleteUser value=<?php echo $u->ident; ?>>Supprimer</button></td>     
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>