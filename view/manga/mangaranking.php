<?php

$title = "Most popular";
ob_start();
?>
<a href="mangas/create">Add a manga</a>
<?php
foreach($mangas as $manga) :
?>
<h2>Most popular mangas</h2>
<div class="manga">
    <img class="cover" src="/Mangatheque/assets/covers/<?= $manga->getCover() ?>" alt="<?= $manga->getName() ?>">
    <h2><?= $manga->getName() ?></h2>
    <p>Nombre de tomes: <?= $manga->getNb_tomes() ?></p>
    <p>Nb of likes: <?= $manga->getLikes() ?> <i class="fa-solid fa-heart"></i></p>
    <p><a href="/Mangatheque/mangas/<?= $manga->getId()?>">Plus d'info</a></p>
    <p><a href="/Mangatheque/mangas/<?= $manga->getId()?>/edit">Modifier</a></p>
</div>

<?php
endforeach;
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';