<div class="col-lg-8 index-bloc-left">

    <h2>Écrits publiés</h2>
    
    <?php
        if (!$articles['query'])
        {
            ?>
                <div class="alert alert-danger">Aucun article trouvé...</div>
            <?php
        }
    ?>
    
    <?php foreach ($articles['query'] as $article): ?>
    
        <h2> 
            <a href="<?= $article->getUrl(); ?>">
                <?= $article->getTitle(); ?>
            </a>
        </h2>
        <h4><?= $article->getCategorie(); ?></h4>
        <?= $article->getExtract(); ?>
    <?php endforeach; ?>
    
    <div class="bloc-pagination-bt">
        <?php
            for ($i = 1; $i <= $articles['nbPage']; $i++){
                if ($i == $articles['cp']){
                    echo '<span class="bt-pagination-off">' . $i . '</span>';
                } else {
                    echo '<span class="bt-pagination-on"> <a href="/writer/web/article/index/' . $i . '">' . $i . '</a></span>';
                }
             }
        ?>
    </div>
</div>

<div class="col-lg-4 index-bloc-right">
   
    <label for="categories">Catégories</label>
    <div class="index-options-bloc">
        <ul>
            <?php foreach($categories as $categorie): ?>
                <li>
                    <a href="<?= $categorie->getUrl(); ?>">
                        <?= $categorie->getName(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <label for="recherche">Recherche</label>
    <div class="index-options-bloc">
        <?= $form->input('recherche', 'Rechercher...'); ?>
        <?= $form->submit('Rechercher'); ?>
    </div>
</div>
