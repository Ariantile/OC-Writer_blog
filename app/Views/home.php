<div id="home-carrousel" class="carousel slide" data-ride="carousel">
  
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#home-carrousel" data-slide-to="0" class="active"></li>
        <li data-target="#home-carrousel" data-slide-to="1"></li>
        <li data-target="#home-carrousel" data-slide-to="2"></li>
        <li data-target="#home-carrousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php for ($c = 0; $c < 4; $c++) {
            if ($c == 0) {
        ?>
               
                <div class="item active">
            
        <?php } else { ?>
               
                <div class="item">
                
        <?php } ?>
                
                <a href="<?= $articles[$c]->getUrl(); ?>">
                    <span class="index-articles-titles"><?= $articles[$c]->getTitle(); ?></span>
                </a>
                <?= $articles[$c]->getCategorie(); ?>
                <?= $articles[$c]->getExtract(); ?>
            </div>
        
        <?php } ?>
    </div>
    
    <a class="left carousel-control" href="#home-carrousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#home-carrousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php
    for ($i = 4; $i < 8; $i++) {

            /*count($articles) $articles[$i]*/
            $date = new DateTime($articles[$i]->getDatePublished());
            $date = $date->format('d/m/Y');
?>
        <h2> 
            <a href="<?= $articles[$i]->getUrl(); ?>">
                <span class="index-articles-titles"><?= $articles[$i]->getTitle(); ?></span>
            </a>
        </h2>
        
        <h4>
            <?= $articles[$i]->getCategorie(); ?> - <?= $date ?>
        </h4>
        
        <?= $articles[$i]->getExtract(); ?>
        
        <hr>
<?php
    }
?>
