<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1>Administration des catégories</h1>
    
    <div class="admin-table-bloc">
    
        <table class="table">
            <thead class="small-hidden">
                <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>
                        Actions
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories['query'] as $categorie): ?>
                    <tr>
                        <td><?= $categorie->id; ?> </td>
                        <td><?= $categorie->name;  ?></td>
                        <td>
                            <a class="bt-custom-action bt-custom-action-edit" href="/writer/web/admin/categorie/edit/<?= $categorie->id; ?>">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>

                            <form action="?p=admin-categorie-delete" style="display: inline;" method="post">
                                <input type="hidden" name="id" value="<?= $categorie->id ?>">
                                <button type="submit" class="bt-custom-action bt-custom-action-delete" href="/writer/web/admin/categorie/delete/<? $categorie->id; ?>">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </button>
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
        
        <hr>
        <div class="row">
            <form method="post" class="admin-add-cat">
                <span class="col-sm-offset-2 col-sm-6 col-xs-offset-2 col-xs-7">
                    <?= $form->input('categorie_new', 'Nouvelle catégorie'); ?>
                </span>
                <span class="col-sm-4 col-xs-4">
                    <?= $form->submit('<i class="fa fa-plus fa-2x" aria-hidden="true"></i>', 'add'); ?>
                </span>
            </form>
        </div>
        <hr>
        
        <div class="bloc-pagination-bt row">
            <?php 
                $cpage  = $categories['cp'];
                $nbPage = $categories['nbPage'];
                $url    = '/writer/web/admin/categories/';
                $pag    = new PaginateNav;
                $pag->getPaginateNav($cpage, $nbPage, $url);
            ?>
        </div>
        
        <hr>
        
        <?php
            }
        ?>
    
    </div>
    
</div>
