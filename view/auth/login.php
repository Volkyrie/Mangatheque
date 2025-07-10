<?php
$title = "Login";
ob_start();
?>
<form action="/mangatheque/login" method="POST">
    <div class="login">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Login" required>
        </div>
    </div>
</form>

<?php
$content = ob_get_contents();
ob_end_clean();

require __DIR__ . '/../base-html.php';