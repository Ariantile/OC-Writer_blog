<script type="text/javascript">
    
    tinymce.init({
        selector: '#write-area',
        height: '350',
        plugins: 'wordcount link hr table preview lists',
        skin: 'writer',
        language: 'fr_FR',
        browser_spellcheck: true,
        toolbar: [
            'newdocument preview | undo redo | cut copy paste | removeformat link blockquote hr table | bullist numlist | outdent indent',
            'formatselect fontselect fontsizeselect |  bold italic underline strikethrough | alignleft aligncenter alignright alignjustify'
        ],
        menubar: false
    });
    
</script> 

    <form method="post">
        
        <div class="col-lg-8 write-bloc-left">
            <div class="writing-bloc">
                <div class="write-form-title first-top">
                    <?= $form->input('title', 'Titre'); ?>
                </div>
                <div>
                    <?= $form->textarea('text'); ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 write-bloc-right">
            <div class="write-form-options-bloc">
               
                <label class="first-top" for="categorie">Catégories</label>
                <div class="write-form-options">
                    <?= $form->select('categorie_id', $categories) ?>
                    <hr>
                    <?= $form->input('categorie_new', 'Nouvelle catégorie'); ?>
                    <br>
                    <?= $form->submit('Ajouter'); ?>
                </div>
                
                <label for="input-publish">Publier</label>
                <div class="write-form-options">
                    <?= $form->checkbox('publish') ?>
                    <hr>
                    <?= $form->submit('Sauvegarder'); ?>
                </div>
                
            </div>
        </div>

    </form>
