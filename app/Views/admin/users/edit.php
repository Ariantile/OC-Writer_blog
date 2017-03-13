<script>
tinymce.init({
        selector: '#mytextarea'
    });
</script> 

<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('username'); ?>
        <?= $form->input('type'); ?>
        <?= $form->input('status') ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
