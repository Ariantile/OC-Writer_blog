<script>
tinymce.init({
    selector: '#mytextarea'
  });
</script> 

<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $comment->username; ?>
        <?= $comment->article; ?>
        <?= $form->input('flag'); ?>
        <?= $form->textarea('comment'); ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
