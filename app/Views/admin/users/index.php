<?php
    use Core\PaginateNav\PaginateNav;
?>

<h1>Administration des utilisateurs</h1>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Type</td>
            <td>Statut</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users['query'] as $user): ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->username;  ?></td>
                <td><?= $user->type;  ?></td>
                <td><?= $user->status;  ?></td>
                <td>
                    <a class="btn btn-primary" href="/writer/web/admin/user/edit/<?= $user->id; ?>">Editer</a>
                    
                    <form action="?p=admin-user-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" class="btn btn-danger" href="/writer/web/admin/user/delete/<? $user->id; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    if (!$users['query'])
    {
        echo '<div class="alert alert-danger">Aucun commentaire trouvé...</div>';
    } else { 
?>
    <div class="bloc-pagination-bt">
        <?php 
            $cpage  = $users['cp'];
            $nbPage = $users['nbPage'];
            $url    = '/writer/web/admin/users/';
            $pag    = new PaginateNav;
            $pag->getPaginateNav($cpage, $nbPage, $url);
        ?>
    </div>
    
<?php
    }
?>
