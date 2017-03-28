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
    
    <form method="post">
        
        <div class="col-lg-8 col-xs-12 write-bloc-left shadow-box-class">
            <div class="write-form-title">
                <?= $form->input('title', 'Titre'); ?>
            </div>
            <div class="write-form-writing-area">
                <?= $form->textarea('text'); ?>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12 write-bloc-right">
            <h2>Catégories &amp; Publication</h2>
            <div class="write-bloc-option row">
                <h4>Catégories</h4>
                <?= $form->select('categorie_id', $categories, '-- Choisir une catégories --') ?>
                <?= $form->input('categorie_new', 'Nouvelle catégorie'); ?>
                <h4 class="write-option-notfirst">Publication</h4>
                <div class="publish-bloc">
                    <?= $form->checkbox('publish', 'PUBLIER') ?>
                    <?= $form->checkbox('comment', 'COMMENTAIRES') ?>
                    <?= $form->token($token) ?>
                </div>
                <?= $form->submit('Sauvegarder'); ?>
            </div>
        </div>
        
    </form>
