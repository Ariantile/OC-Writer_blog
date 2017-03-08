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
        <?php foreach($articles as $article): ?>
            <tr>
                <td><?= $article->id; ?></td>
                <td><?= $article->title;  ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin-article-edit&id=<?= $article->id; ?>">Editer</a>
                    
                    <form action="?p=admin-article-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $article->id ?>">
                        <button type="submit" class="btn btn-danger" href="?p=admin-article-delete&id=<? $article->id; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>