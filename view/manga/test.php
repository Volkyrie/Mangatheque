<?php
$title = "Sorted manga";
ob_start();
?>

<div>
    <?php if($user->liked($manga->getId())) : ?>
        <a href="/Mangatheque/mangas/<?php $manga->getId()?>/like"><i class="fa-solid fa-heart"></i></a>
    <?php else: ?>
        <a href="/Mangatheque/mangas/<?php $manga->getId()?>/unlike"><i class="fa-regular fa-heart"></i></a>  
    <?php endif ?>
    <span>Nb of likes: <?php $manga->getLikes($manga->getId()); ?></span>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';