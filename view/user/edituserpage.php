<?php
$title = "Update user {$id}";
ob_start();
?>

<form method="POST" action="<?= $id ?>">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" value="<?= $user->getPseudo()?>"><br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= $user->getEmail()?>"><br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" value="<?= $user->getPassword()?>"><br>
    <button type="submit" name="update">Mettre à jour</button>
</form>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once './view/base-html.php';