<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('title'); ?>
        <?= $form->textarea('text'); ?>
        <?= $form->select('categorie_id', 'Categorie', $categorie) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
