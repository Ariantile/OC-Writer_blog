<script>
tinymce.init({
        selector: '#mytextarea'
    });
</script> 

<div class="bloc-form">
    <h2 class="edit-form-title">Éditer un utilisateur</h2>
    <form method="post" class="edit-form">
        <?= $form->input('username'); ?>
        <?= $form->selectUserAdmin('type', $user); ?>
        <?= $form->selectUserAdmin('status', $user); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
