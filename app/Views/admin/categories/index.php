<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1>Administration des catégories</h1>
    
    <?php if(isset($msg)) { ?>
        <div class="alert alert-info msg-cont">
            <?= $msg; ?>
        </div>
    <?php } ?>
    
    <div class="msg-cont-aj">
        
    </div>
    
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
                    <tr id="row-<?= $categorie->id; ?>">
                        <td><?= $categorie->id; ?> </td>
                        <td><?= $categorie->name;  ?></td>
                        <td>
                            <a class="bt-custom-action bt-custom-action-edit" href="/writer/web/admin/categorie/edit/<?= $categorie->id; ?>">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>

                            <div style="display: inline;">
                                <input type="hidden" name="id" value="<?= $categorie->id ?>">
                                <button id="del-<?= $categorie->id; ?>" data-id="<?= $categorie->id; ?>" type="button" class="bt-custom-action bt-custom-action-delete delete-cat">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </button>
                            </div>
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
                <span class="col-sm-offset-3 col-sm-5 col-xs-10">
                    <?= $form->input('categorie', 'Nouvelle catégorie', null, ['required' => true]); ?>
                    <?= $form->token($token) ?>
                </span>
                <span class="col-sm-3 col-xs-2 add-cat-cont">
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
