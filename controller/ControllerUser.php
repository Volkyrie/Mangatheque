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
            $author = $modelManga->searchAuthor();
            $category = $modelManga->searchCategory(trim($_POST['category']));
            $success = $modelUser->updateOneUserById($id, trim($_POST['cover']), trim($_POST['name']),
                        trim($_POST['synopsis']), trim($_POST['rating']), trim($_POST['publication']),
                        trim($_POST['author']),trim($_POST['category']), trim($_POST['nbtomes']));
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