<?php

$title = "Liste des mangas";
ob_start();
?>
<a href="mangas/create">Add a manga</a>
<?php
foreach($mangas as $manga) :
?>

<div class="manga">
    <img class="cover" src="./assets/covers/<?= $manga->getCover() ?>" alt="<?= $manga->getName() ?>">
    <h2><?= $manga->getName() ?></h2>
    <p>Nombre de tomes: <?= $manga->getNb_tomes() ?></p>
    <p><a href="mangas/<?= $manga->getId()?>">Plus d'info</a></p>
    <p><a href="mangas/<?= $manga->getId()?>/edit">Modifier</a></p>
</div>

<?php
endforeach;
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';