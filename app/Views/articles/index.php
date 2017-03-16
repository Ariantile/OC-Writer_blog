<?php
    use Core\PaginateNav\PaginateNav;
?>

<div class="col-lg-8 col-xs-12 index-bloc-left shadow-box-class">

    <h2 class="index-title">Écrits publiés</h2>
    
    <?php
        if (!$articles['query'])
        {
            ?>
                <div class="alert alert-danger">Aucun article trouvé...</div>
            <?php
        }
    ?>
    
    <?php foreach ($articles['query'] as $article): ?>
       
        <?php
            $date = new DateTime($article->getDatePublished());
            $date = $date->format('d/m/Y');
        ?>
        
        <h2> 
            <a href="<?= $article->getUrl(); ?>">
                <span class="index-articles-titles"><?= $article->getTitle(); ?></span>
            </a>
        </h2>
        
        <h4>
            <?= $article->getCategorie(); ?> - <?= $date ?>
        </h4>
        
        <?= $article->getExtract(); ?>
        
        <hr>
        
    <?php endforeach; ?>

    <div class="bloc-pagination-bt row">
        <?php 
            $cpage  = $articles['cp'];
            $nbPage = $articles['nbPage'];
            if (isset($type) && $type == 'search' && isset($key)) {
                $url    = '/writer/web/article/recherche/' . $key . '/';
            } else if(isset($type) && $type == 'cat' && isset($catId)) {
                $url    = '/writer/web/article/index/cat/' . $catId . '/';
            } else {
                $url    = '/writer/web/article/index/';
            }    
            $pag    = new PaginateNav;
            $pag->getPaginateNav($cpage, $nbPage, $url);
        ?>
    </div>
    
    <hr>
    
</div>

<div class="col-lg-4 col-xs-12 index-bloc-right">
    
    <label for="categories">Catégories</label>
    <div class="index-options-bloc">
        <ul class="index-cat-list">
            <?php foreach($categories as $categorie): ?>
                <li>
                    <a href="<?= $categorie->getUrl(); ?>">
                        <?= $categorie->getName(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
</div>

<button id="showRight" class="showRight-index">
    <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
</button>

<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">

    <div class="top-side-menu"> 
       
        <button id="closeRight">
            <i class="fa fa-times fa-lg" aria-hidden="true"></i>
        </button>
        
        <h2>Catégories</h2>
        
        <div class="index-options-bloc-sm">
            <ul class="index-cat-list-sm">
                <?php foreach($categories as $categorie): ?>
                    <li>
                        <a href="<?= $categorie->getUrl(); ?>">
                            <?= $categorie->getName(); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
    </div>
    
</div>

<script src="/writer/web/js/menu-script.js"></script>
