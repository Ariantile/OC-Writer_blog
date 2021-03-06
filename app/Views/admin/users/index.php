<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="admin-bloc-left">
    
    <h1 id="title-admin">Administration des utilisateurs</h1>
    
    <?php if(isset($msg)) { ?>
        <div class="alert alert-info msg-cont">
            <?= $msg; ?>
        </div>
    <?php } ?>
    
    <div class="admin-table-bloc">

        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Type</td>
                    <td>Statut</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users['query'] as $user): ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td>
                            <a href="<?= $user->getUrl(); ?>" class="link-custom">
                                <?= $user->username;  ?>
                            </a>
                        </td>
                        <td><?= $user->type;  ?></td>
                        <td>
                            <?php 
                                if ($user->status == 'Validated') {
                                    echo '<span class="feature-active"><i class="fa fa-check fa-2x" aria-hidden="true"></i></span>';
                                } else {
                                    echo '<span class="feature-not-active"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a class="bt-custom-action bt-custom-action-edit" href="/writer/web/admin/user/edit/<?= $user->id; ?>">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php
            if (!$users['query'])
            {
                echo '<div class="alert alert-danger">Aucun commentaire trouvé...</div>';
            } else { 
        ?>
            <div class="bloc-pagination-bt">
                <?php 
                    $cpage  = $users['cp'];
                    $nbPage = $users['nbPage'];
                    $url    = '/writer/web/admin/users/';
                    $pag    = new PaginateNav;
                    $pag->getPaginateNav($cpage, $nbPage, $url);
                ?>
            </div>

        <?php
            }
        ?>
        
    </div>
    
</div>
