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
    
    <button id="showRight">
        <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
    </button>
    
    <form method="post">
        
        <div class="write-bloc-left">
            <div class="writing-bloc">
                <div class="write-form-title first-top">
                    <?= $form->input('title', 'Titre'); ?>
                </div>
                <div>
                    <?= $form->textarea('text'); ?>
                </div>
            </div>
        </div>

        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">

            <div class="top-side-menu"> 
                <button id="closeRight" type="button">
                    <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                </button>
            </div>

            <h2>Catégories</h2>
            <div class="reading-font-bloc row">
                <?= $form->select('categorie_id', $categories) ?>
                <hr>
                <?= $form->input('categorie_new', 'Nouvelle catégorie'); ?>
                <br>
                <?= $form->submit('Ajouter'); ?>
            </div>

            <h2>Publier</h2>
            <div class="reading-size-bloc row">
                <?= $form->checkbox('publish') ?>
                <hr>
                <?= $form->submit('Sauvegarder'); ?>
            </div>

        </div>
        
</form>

<script src="/writer/web/js/menu-script.js"></script>