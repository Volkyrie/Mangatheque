<?php
$title = "Sorted manga";
ob_start();
?>

<div>
    <h2><?= $category['name'] ?></h2>
    <?php
        foreach($mangas as $manga) :
            if(strpos($manga->getCategory(), $category['name']) !== false) :
    ?>
        <div class="manga">
            <img class="cover" src="../../assets/covers/<?= $manga->getCover() ?>" alt="<?= $manga->getName() ?>">
            <h3><?= $manga->getName() ?></h3>
            <p>Nombre de tomes: <?= $manga->getNb_tomes() ?></p>
            <p>Category: <?= $manga->getCategory() ?></p>
            <p><a href="/Mangatheque/mangas/<?= $manga->getId()?>">Plus d'info</a></p>
            <p><a href="/Mangatheque/mangas/<?= $manga->getId()?>/edit">Modifier</a></p>
        </div>
    <?php
        endif;
        endforeach;
    ?>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';