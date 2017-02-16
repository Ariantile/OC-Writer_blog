<h1>Administration catégories</h1>

<p>
    <a href="?p=admin-categorie-add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $categorie): ?>
            <tr>
                <td><?= $categorie->id; ?></td>
                <td><?= $categorie->name;  ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin-categorie-edit&id=<?= $categorie->id; ?>">Editer</a>
                    
                    <form action="?p=admin-categorie-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $categorie->id ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>