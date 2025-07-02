<?php

$title = "Utilisateur supprimé";
ob_start();
?>

<div class="user">
    <h2>Utilisateur supprimé avec succès</h2>
    <p><a href="">Retourner à la page d'accueil</a></p>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';