<?php
    use Core\PaginateNav\PaginateNav;
?>

<h1>Administration catégories</h1>

<p>
    <a href="?p=admin-categorie-add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories['query'] as $categorie): ?>
            <tr>
                <td><?= $categorie->id; ?></td>
                <td><?= $categorie->name;  ?></td>
                <td>
                    <a class="btn btn-primary" href="/writer/web/admin/categorie/edit/<?= $categorie->id; ?>">Editer</a>
                    
                    <form action="?p=admin-categorie-delete" style="display: inline;" method="post">
                        <input type="hidden" name="id" value="<?= $categorie->id ?>">
                        <button type="submit" class="btn btn-danger" href="/writer/web/admin/categorie/delete/<? $categorie->id; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    if (!$categories['query'])
    {
        echo '<div class="alert alert-danger">Aucune catégorie trouvée...</div>';
    } else { 
?>
    <div class="bloc-pagination-bt">
        <?php 
            $cpage  = $categories['cp'];
            $nbPage = $categories['nbPage'];
            $url    = '/writer/web/admin/categories/';
            $pag    = new PaginateNav;
            $pag->getPaginateNav($cpage, $nbPage, $url);
        ?>
    </div>
    
<?php
    }
?>
