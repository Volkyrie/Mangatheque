<?php
class ControllerUser {
    public function oneUserById(int $id) {
        $modelUser = new ModelUser();
        $user = $modelUser->getOneUserById($id);
        if(!$user) {
            http_response_code(404);
            require './view/user/usernotfound.php';
            exit;
        }

        require './view/user/userpage.php';
    }

    public function deleteUserById(int $id) {
        $modelUser = new ModelUser();
        $success = $modelUser->deleteOneUserById($id);

        if(!$success) {
            http_response_code(404);
            $error = "Aucun user n'a été supprimé";
        } else {
            $message = "User supprimé";
        }

        header('Location: /mangatheque/');
    }
}