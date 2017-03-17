<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1>Administration des commentaires</h1>
    
    <div class="admin-table-bloc">
    
        <table class="table">
            <thead class="small-hidden">
                <tr>
                    <td>ID</td>
                    <td>Flag</td>
                    <td>Utilisateur</td>
                    <td>Article</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments['query'] as $comment): ?>
                    <tr>
                        <td><?= $comment->id; ?></td>
                        <td>
                            <?php 
                                if ($comment->flag == true) {
                                    echo '<span class="feature-active-flag"><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i></i></span>';
                                } else {
                                    echo '<span class="feature-not-active"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="<?= $comment->getUserUrl(); ?>" class="link-custom">
                                <?= $comment->username;  ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= $comment->getArticleUrl(); ?>" class="link-custom">
                                <?= $comment->title;  ?>
                            </a>
                        </td>
                        <td>
                            <a class="bt-custom-action bt-custom-action-edit" href="/writer/web/admin/comment/edit/<?= $comment->id; ?>">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>

                            <form action="?p=admin-comment-delete" style="display: inline;" method="post">
                                <input type="hidden" name="id" value="<?= $comment->id ?>">
                                <button type="submit" class="bt-custom-action bt-custom-action-delete" href="/writer/web/admin/comment/delete/<? $comment->id; ?>">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </button>
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
        
        <hr>
        
        <div class="bloc-pagination-bt row">
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
        
        <hr>
        
    </div>
</div>
