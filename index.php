<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangatheque</title>
</head>
<body>
    <?php
        if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
            $pseudo = $_POST['pseudo'];
            $pwd = $_POST['pwd'];

            $dbh = new PDO('mysql:host=localhost;dbname=mangatheque', 'root', 'root');
            $req = $dbh->prepare("SELECT id, pseudo, password FROM user WHERE pseudo = :pseudo");
            $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $req->execute();

            if($req->rowCount() == 1) {
                $user = $req->fetch(PDO::FETCH_ASSOC);
                if($user['password'] == $pwd) {
                    echo '<h1>Bonjour ' . $user['pseudo'] . '</h1>';
                }
            } else {
                echo '<p style="color: red;"> Mauvais pseudo ou mdp</p>';
            }
        } else {
            $error = '<p style="color: red;">Vous devez saisir pseudo et mot de passe</p>';
        }
    ?>
    <form action="#" method="POST">
        <?php 
            if(isset($error)) {
                echo $error;
            }
        ?>
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo">
        </div>
        <div>
            <label for="pwd">Password</label>
            <input type="password" name="pwd" id="pwd">
        </div>
        <div>
            <input type="submit" value="Connexion">
        </div>
    </form>
</body>
</html>