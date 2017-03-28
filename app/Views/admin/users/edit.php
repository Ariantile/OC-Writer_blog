<script>
tinymce.init({
        selector: '#mytextarea'
    });
</script> 

<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('username'); ?>
        <?= $form->selectUserAdmin('type', $user); ?>
        <?= $form->selectUserAdmin('status', $user); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
