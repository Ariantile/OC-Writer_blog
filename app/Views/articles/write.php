<script type="text/javascript">
    
    tinymce.init({
        selector: '#write-area',
        plugins: 'wordcount link hr table preview lists',
        skin: 'writer',
        language: 'fr_FR',
        toolbar: [
            'newdocument preview | undo redo | cut copy paste | removeformat link blockquote hr table | bullist numlist | outdent indent',
            'formatselect fontselect fontsizeselect |  bold italic underline strikethrough | alignleft aligncenter alignright alignjustify'
        ],
        menubar: false
    });
    
</script> 

<div class="bloc-form">
    <form method="post">
        
        <div class="col-lg-8">
            <div class="write-form">
                <?= $form->input('title'); ?>
            </div>

            <div class="write-form">
                <?= $form->textarea('text'); ?>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="write-form">
                <?= $form->select('categorie_id', 'Categorie', $categories) ?>
                <?= $form->checkbox('publish') ?>
                <?= $form->submit('Sauvegarder'); ?>
            </div>
        </div>

    </form>
</div>
