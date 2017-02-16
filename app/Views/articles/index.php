<h2>Livres publiés</h2>

<?php

    if (!$articles)
    {
        ?>
            <div class="alert alert-danger">Aucun article trouvé...</div>
        <?php
    }
?>

<?php foreach ($articles as $article): ?>

    <h2> 
       <a href="<?= $article->getUrl(); ?>">
            <?= $article->getTitle(); ?>
        </a>
    </h2>
    <h4><?= $article->getCategorie(); ?></h4>
    <p>
        <?= $article->getExtract(); ?>
    </p>
    
<?php endforeach; ?>

<ul>
    <?php foreach($categories as $categorie): ?>
        <li>
            <a href="<?= $categorie->getUrl(); ?>">
                <?= $categorie->getName(); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
