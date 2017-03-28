<script>
tinymce.init({
    selector: '#mytextarea'
  });
</script> 

<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('title'); ?>
        <?= $form->textarea('text'); ?>
        <?= $form->select('categorie', $categories, null) ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
