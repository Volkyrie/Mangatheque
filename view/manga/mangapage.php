<?php

$title = "Manga: {$manga->getName()}";
ob_start();
?>

<div class="manga">
    <img class="cover" src="../assets/covers/<?= $manga->getCover() ?>" alt="<?= $manga->getName() ?>">
    <h2><?= $manga->getName() ?></h2>
    <p>Number of tomes: <?= $manga->getNb_tomes() ?></p>
    <p>Rating: <?= $manga->getRating() ?> /10 ⭐ </p>
    <p>Published on: <?= $manga->getPublished_at()->format('d M Y') ?></p>
    <p>Written by: <?= $manga->getAuthor() ?></p>
    <p>Category: <?= $manga->getCategory() ?></p>
    <p>Synopsis:<br><?= $manga->getSynopsis() ?></p>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';