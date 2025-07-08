<?php

$title = "Add a manga";
ob_start();
?>

<form method="POST" action="../mangas/store">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value=""><br>
    <label for="author">Author</label>
    <input type="text" name="author" id="author" value=""><br>
    <label for="synopsis">Synopsis</label>
    <textarea type="text" name="synopsis" id="synopsis" ></textarea><br>
    <label for="rating">Rating</label>
    <input type="number" name="rating" id="ratijng" value=""><br>
    <label for="cover">Cover</label>
    <input type="text" name="cover" id="cover" value=""><br>
    <label for="nb_tomes">Number of tomes</label>
    <input type="text" name="nbtomes" id="nbtomes" value=""><br>
    <label for="publication">Publication date</label>
    <input type="date" name="publication" id="publication" value=""><br>
    <label for="category">Category</label>
    <input type="text" name="category" id="category" value=""><br>
    <button type="submit" name="update">Mettre à jour</button>
</form>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';