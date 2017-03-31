<?php
    use Core\PaginateComments\PaginateComments;
    use Core\PaginateNav\PaginateNav;
?>

<?php
    $dateP = $article->getDatePublished();
    $date = date_create($dateP);   
?>   

<button id="showRight">
    <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
</button>

<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>

<div class="read-bloc-left">
    
    <div class="read-title-bloc">
        <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
        <h4><?= htmlspecialchars($article->getCategorie()); ?> - <small>dernière mise à jour le <?= $date->format('d/m/Y'); ?></small></h4>
    </div>
    
    
    <div class="reading-bloc font-nm font-open color-black-white">
        <?= $article->getText(); ?>
    </div>
    
    <div class="comment-container">
        <h4 class="comments-title">Commentaires</h1>
        <hr>
        <?php
            if (!empty($comments['query'])) {
                $pagComments = new PaginateComments;
                $pagComments->showComments($comments['query']);
            } else {
                echo '<p class="no-comment">Il n\'y a pas de commentaire. Soyez le premier à commenter cette article!</p>';
            }
            
        ?>

        <?= $form->cur($cur) ?>
    
        <hr>
        <div class="bloc-pagination-bt row">

            <?php 
                $cpage  = $comments['cp'];
                $nbPage = $comments['nbPage'];
                $url    = '/writer/web/article/' . $article->getId() . '/';
                $pag    = new PaginateNav;
                $pag->getPaginateNav($cpage, $nbPage, $url);
            ?>

        </div>
        <hr>
        
        <?php 
            if ($article->commentsActive == false) {
                echo '<p class="alert alert-warning">Commentaires désactivés.</p>';
            } else if ($article->commentsActive == true && isset($_SESSION['type']) && 
                       ($_SESSION['type'] == 'Admin' || $_SESSION['type'] == 'Membre'))
            {
        ?>
            <form method="post" class="form-comment" id="form-comment">
                <h4 class="post-comment-title">Poster un commentaire</h1>
                <?= $form->token($token) ?>
                <?= $form->responseid(); ?>
                <?= $form->textarea('comment', ['max' => 500, 'required' => true]); ?>
                <?= $form->submit('Commenter'); ?>
            </form>
        <?php
            } else {
        ?>
            <p class="not-logged">Vous devez vous <a href="/writer/web/login">identifier</a> pour poster un commentaire.</p>
        <?php        
            }
        ?>
        <hr>
    </div>
    
    
</div>

<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">

    <div class="top-side-menu"> 
        <button id="closeRight">
            <i class="fa fa-times fa-lg" aria-hidden="true"></i>
        </button>
    </div>
    
    <h2>Police du texte</h2>
    <div class="reading-font-bloc row">
        <button id="font-gara" class="reading-options-bt">Garamond</button>
        <button id="font-bask" class="reading-options-bt">Baskerville</button>
        <button id="font-open" class="reading-options-bt reading-options-bt-active">Open Sans</button>
        <button id="font-robo" class="reading-options-bt">Roboto</button>
        <button id="font-aria" class="reading-options-bt">Arial</button>
        <button id="font-time" class="reading-options-bt">Times New Roman</button>
    </div>
    
    <h2>Taille du texte</h2>
    <div class="reading-size-bloc row">
        <button id="font-xs" class="reading-options-bt">Très petit</button>
        <button id="font-sm" class="reading-options-bt">Petit</button>
        <button id="font-nm" class="reading-options-bt reading-options-bt-active">Normal</button>
        <button id="font-lg" class="reading-options-bt">Grand</button>
        <button id="font-xl" class="reading-options-bt">Très grand</button>
    </div>
    
    <h2>Couleur du texte et du fond</h2>
    <div class="reading-color-bloc row">
        <button id="color-black-white" class="reading-options-bt reading-options-bt-active">Noir et blanc</button>
        <button id="color-white-black" class="reading-options-bt">Blanc et noir</button>
    </div>
    
</div>

<script src="/writer/web/js/menu-script.js"></script>
