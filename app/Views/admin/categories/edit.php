<div class="bloc-form">
    <h2 class="edit-form-title">Éditez votre catégorie</h2>
    <form method="post" class="edit-form">
        <?= $form->input('name'); ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
