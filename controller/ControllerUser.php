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
        exit;
    }

    public function updateUserById(int $id) {
        $modelUser = new ModelUser();
        if(isset($_POST['update'])) {
            $success = $modelUser->updateOneUserById($id, trim($_POST['pseudo']), trim($_POST['email']), trim($_POST['password']));
            if(!$success) {
                http_response_code(404);
                $error = "Aucun user n'a été mis à jour";
            } else {
                $message = "User mis à jour";
            }
            header('Location: /mangatheque/');
            exit;
        } else {
            $user = $modelUser->getOneUserById($id);
            if($user == NULL) {
                $error = "Aucun user trouvé";
                header('Location: /mangatheque/');
                exit;
            }
            require './view/user/edituserpage.php';
        }
    }
}