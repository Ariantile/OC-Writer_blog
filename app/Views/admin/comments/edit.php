<script>
tinymce.init({
    selector: '#mytextarea'
  });
</script> 

<div class="bloc-form">
    <h2 class="edit-form-title">
        Éditer un commentaire
        <div class="commentaire-info-admin">
            Utilisateur
            <a href="<?= $comment->getUserUrl(); ?>">
                <?= $comment->username; ?>
            </a>
             - Article
            <a href="<?= $comment->getArticleUrl(); ?>">
                <?= $comment->title; ?>
            </a>
        </div>
    </h2>
    <form method="post" class="edit-form">
        <div class="info-admin">Commentaire signalé par un membre? <?= $form->checkboxAdmin('flag', 'flag'); ?></div>
        
        <?= $form->textarea('comment', ['max' => 500, 'required' => true]); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
