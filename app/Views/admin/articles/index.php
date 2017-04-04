<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1 id="title-admin">Administration des articles postés</h1>
    
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
                    <td>Titre</td>
                    <td>Article publié</td>
                    <td>Commentaires actifs</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles['query'] as $article): ?>
                    <tr id="row-<?= $article->id; ?>">
                        <td ><?= $article->id; ?></td>
                        <td>
                            <a href="<?= $article->getUrl(); ?>" class="link-custom">
                                <?= $article->title;  ?>
                            </a>
                        </td>
                        <td>
                            <?php 
                                if ($article->published == true) {
                                    echo '<span class="feature-active"><i class="fa fa-check fa-2x" aria-hidden="true"></i></span>';
                                } else {
                                    echo '<span class="feature-not-active"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>';
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if ($article->commentsActive == true) {
                                    echo '<span class="feature-active"><i class="fa fa-check fa-2x" aria-hidden="true"></i></span>';
                                } else {
                                    echo '<span class="feature-not-active"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a class="bt-custom-action bt-custom-action-edit" href="/writer/web/admin/article/edit/<?= $article->id; ?>">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>
                            
                            <div style="display: inline;">
                                <button id="confirm-<?= $article->id; ?>" data-id="<?= $article->id; ?>" type="button" class="bt-custom-action bt-custom-action-delete modal-delete-article">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal -->
        <?php foreach ($articles['query'] as $article): ?>
            <div id="modal-<?= $article->id; ?>" class="modal modal-hide">

                <div class="modal-content">
                    <div class="modal-but-cont">
                        
                    
                    <input type="hidden" name="id" value="<?= $article->id ?>">
                    <button id="del-<?= $article->id; ?>" data-id="<?= $article->id; ?>" type="button" class="modal-but-conf delete-article">
                        Confirmer
                    </button>
                    <button id="cancel-<?= $article->id; ?>" data-id="<?= $article->id; ?>" type="button" class="modal-but-cancel cancel-delete">
                        Annuler
                    </button>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        
        <?php
            if (!$articles['query'])
            {
                echo '<div class="alert alert-danger">Aucun article trouvé...</div>';
            } else { 
        ?>
        
        <?= $form->token($token) ?>
        
        <hr>
        <div class="bloc-pagination-bt row">
            
            <?php 
                $cpage  = $articles['cp'];
                $nbPage = $articles['nbPage'];
                $url    = '/writer/web/admin/articles/';
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
