<?php
class ControllerPage {
    public function homePage() {
        if(!isset($_SESSION['id'])) {
            header('Location: /mangatheque/login');
            exit;
        }
        $modelUser = new ModelUser();
        $users = $modelUser->getUsers();
        require './view/page/homepage.php';
    }
}