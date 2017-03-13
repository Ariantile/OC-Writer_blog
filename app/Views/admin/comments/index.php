<?php
    use Core\PaginateNav\PaginateNav;
?>

<h1>Administration des articles postés</h1>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Flag</td>
            <td>User</td>
            <td>Article</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments['query'] as $comment): ?>
            <tr>
                <td><?= $comment->id; ?></td>
                <td><?= $comment->flag;  ?></td>
                <td><?= $comment->username;  ?></td>
                <td><?= $comment->article;  ?></td>
                <td>
                    <a class="btn btn-primary" href="/writer/web/admin/comment/edit/<?= $comment->id; ?>">Editer</a>
                    
                    <form action="?p=admin-comment-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $comment->id ?>">
                        <button type="submit" class="btn btn-danger" href="/writer/web/admin/comment/delete/<? $comment->id; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    if (!$comments['query'])
    {
        echo '<div class="alert alert-danger">Aucun commentaire trouvé...</div>';
    } else { 
?>
    <div class="bloc-pagination-bt">
        <?php 
            $cpage  = $comments['cp'];
            $nbPage = $comments['nbPage'];
            $url    = '/writer/web/admin/comments/';
            $pag    = new PaginateNav;
            $pag->getPaginateNav($cpage, $nbPage, $url);
        ?>
    </div>
    
<?php
    }
?>
