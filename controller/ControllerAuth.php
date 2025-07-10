<?php
class ControllerAuth {
    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['error'] = "Tous les champs doivent être remplis.";
                header('Location: /mangatheque/register');
                exit;
            }

            $pseudo = trim($_POST['pseudo']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            $modelUser = new ModelUser();
            $successUser = $modelUser->createUser($pseudo, $email, $password);
        
            if($successUser) {
                $_SESSION['success'] = "Vous êtes bien enregistré. Vous pouvez vous connecter !";
                header('Location: /mangatheque/login');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de l'insertion.";
                header('Location: /mangatheque/register');
                exit;
            }
        }
        require __DIR__ . '/../view/auth/register.php';
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['error'] = "Tous les champs doivent être remplis.";
                header('Location: /mangatheque/register');
                exit;
            }

            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            $modelUser = new ModelUser();
            $user = $modelUser->searchUser($email);
            if(password_verify($password, $user['password'])) {
                $_SESSION['success'] = "Vous êtes connecté.";
                header('Location: /mangatheque/mangas');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la connexion, vérifiez votre email et votre mot de passe.";
                header('Location: /mangatheque/login');
                exit;
            }
        }
        require __DIR__ . '/../view/auth/login.php';
    }
}