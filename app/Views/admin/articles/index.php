<?php
    use Core\PaginateNav\PaginateNav;
?>

<h1>Administration des articles postés</h1>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles['query'] as $article): ?>
            <tr>
                <td><?= $article->id; ?></td>
                <td><?= $article->title;  ?></td>
                <td>
                    <a class="btn btn-primary" href="/writer/web/admin/article/edit/<?= $article->id; ?>">Editer</a>
                    
                    <form action="?p=admin-article-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $article->id ?>">
                        <button type="submit" class="btn btn-danger" href="/writer/web/admin/article/delete/<? $article->id; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    if (!$articles['query'])
    {
        echo '<div class="alert alert-danger">Aucun article trouvé...</div>';
    } else { 
?>
    <div class="bloc-pagination-bt">
        <?php 
            $cpage  = $articles['cp'];
            $nbPage = $articles['nbPage'];
            $url    = '/writer/web/admin/articles/';
            $pag    = new PaginateNav;
            $pag->getPaginateNav($cpage, $nbPage, $url);
        ?>
    </div>
    
<?php
    }
?>
