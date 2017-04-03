<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1>Administration des articles postés</h1>
    
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
                    <tr>
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

                            <form action="?p=admin-article-delete" style="display: inline;" method="post">
                                <input type="hidden" name="id" value="<?= $article->id ?>">
                                <button type="submit" class="bt-custom-action bt-custom-action-delete" href="/writer/web/admin/article/delete/<? $article->id; ?>">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </button>
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
