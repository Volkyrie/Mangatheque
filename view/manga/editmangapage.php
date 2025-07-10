<?php
$title = "Update manga {$id}";
ob_start();
?>

<form method="POST" action="/mangatheque/mangas/<?= $id ?>/edit">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?= $manga->getName()?>"><br>
    <label for="author">Author</label>
    <input type="text" name="author" id="author" value="<?= $manga->getAuthor()?>"><br>
    <label for="synopsis">Synopsis</label>
    <textarea type="text" name="synopsis" id="synopsis" ><?= $manga->getSynopsis()?></textarea><br>
    <label for="rating">Rating</label>
    <input type="number" name="rating" id="ratijng" value="<?= $manga->getRating()?>"><br>
    <label for="cover">Cover</label>
    <input type="text" name="cover" id="cover" value="<?= $manga->getCover()?>"><br>
    <label for="nbtomes">Number of tomes</label>
    <input type="text" name="nb_tomes" id="nb_tomes" value="<?= $manga->getNb_tomes()?>"><br>
    <label for="publication">Publication date</label>
    <input type="date" name="publication" id="publication" value="<?= $manga->getPublished_at()->format('Y-m-d')?>"><br>
    <label for="category">Category</label>
    <input type="text" name="category" id="category" value="<?= $manga->getCategory()?>"><br>
    <button type="submit" name="update">Mettre à jour</button>
</form>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';