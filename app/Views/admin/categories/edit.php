<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('name'); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
