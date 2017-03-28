<script>
tinymce.init({
    selector: '#mytextarea'
  });
</script> 

<div class="bloc-form">
    <form method="post" class="edit-form">
        <a href="<?= $comment->getUserUrl(); ?>">
            <?= $comment->username; ?>
        </a>
        
        <a href="<?= $comment->getArticleUrl(); ?>">
            <?= $comment->title; ?>
        </a>

        <?= $form->checkboxAdmin('flag', 'flag'); ?>
        <?= $form->textarea('comment'); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
