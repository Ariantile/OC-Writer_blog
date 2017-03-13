<?php
    $dateP = $article->getDatePublished();
    $date = date_create($dateP);   
?>   

<div class="col-lg-8 index-bloc-left">
    
    <div class="read-title-bloc">
        <h2><?= $article->getTitle(); ?></h2>
        <h4><?= $article->getCategorie(); ?> - <small>dernière mise à jour le <?= $date->format('d/m/Y'); ?></small></h4>
    </div>
    
    
    <div class="reading-bloc font-nm font-open color-black-white">
        <?= $article->getText(); ?>
    </div>
    
</div>

<div class="col-lg-4 read-bloc-right">
    
    <h2>Police du texte</h2>
    <div class="reading-font-bloc row">
        <button id="font-gara" class="reading-options-bt">Garamond</button>
        <button id="font-bask" class="reading-options-bt">Baskerville</button>
        <button id="font-open" class="reading-options-bt reading-options-bt-active">Open Sans</button>
        <button id="font-robo" class="reading-options-bt">Roboto</button>
        <button id="font-aria" class="reading-options-bt">Arial</button>
        <button id="font-time" class="reading-options-bt">Times New Roman</button>
    </div>
    
    <h2>Taille du texte</h2>
    <div class="reading-size-bloc row">
        <button id="font-xs" class="reading-options-bt">Très petit</button>
        <button id="font-sm" class="reading-options-bt">Petit</button>
        <button id="font-nm" class="reading-options-bt reading-options-bt-active">Normal</button>
        <button id="font-lg" class="reading-options-bt">Grand</button>
        <button id="font-xl" class="reading-options-bt">Très grand</button>
    </div>
    
    <h2>Couleur du texte et du fond</h2>
    <div class="reading-color-bloc row">
        <button id="color-black-white" class="reading-options-bt reading-options-bt-active">Noir et blanc</button>
        <button id="color-white-black" class="reading-options-bt">Blanc et noir</button>
    </div>

</div>
