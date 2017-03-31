<script type="text/javascript">
    
    tinymce.init({
        selector: '#write-area',
        height: '350',
        plugins: 'wordcount link hr table preview lists',
        skin: 'writer',
        language: 'fr_FR',
        browser_spellcheck: true,
        toolbar: [
            'newdocument preview | undo redo | cut copy paste | removeformat link blockquote hr table | bullist numlist | outdent indent | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify',
            'formatselect | fontselect | fontsizeselect |'
        ],
        menubar: false
    });
    
</script> 

<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>

<div class="bloc-form">
    <form method="post" class="edit-form">
        <?= $form->input('title'); ?>
        <?= $form->textarea('text'); ?>
        <?= $form->select('categorie', $categories, null, ['type' => 'cat_write']) ?>
        <?= $form->token($token) ?>
        <?= $form->submit('Sauvegarder'); ?>
    </form>
</div>
