<?php

$title = "Manga: {$manga->getName()}";
ob_start();
?>

<div class="manga">
    <img class="cover" src="/Mangatheque/assets/covers/<?= $manga->getCover() ?>" alt="<?= $manga->getName() ?>">
    <h2><?= $manga->getName() ?></h2>
    <p>Number of tomes: <?= $manga->getNb_tomes() ?></p>
    <p>Rating: <?= $manga->getRating() ?> /5 ⭐ </p>
    <p>Published on: <?= $manga->getPublished_at()->format('d M Y') ?></p>
    <p>Written by: <?= $manga->getAuthor() ?></p>
    <p>Category: <?= $manga->getCategory() ?></p>
    <div>
        <?php if($isLiked == false) : ?>
            <a href="/Mangatheque/mangas/<?php echo $manga->getId()?>/like"><i class="fa-regular fa-heart"></i></a>&nbsp&nbsp
        <?php else: ?>
            <a href="/Mangatheque/mangas/<?php echo $manga->getId()?>/unlike"><i class="fa-solid fa-heart"></i></a>&nbsp&nbsp  
        <?php endif ?>
        <span>Nb of likes: <?php echo $nbLikes ?></span>
    </div>
    <p>Synopsis:<br><?= $manga->getSynopsis() ?></p>
    <form action="/Mangatheque/mangas/<?php echo $manga->getId()?>/rate" method="GET">
        <p>
            <label for="rate">Rate this manga: </label>
            <select name="rate" id="rate">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>⭐
            <button type="submit">Vote!</button>
        </p>
    </form>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';