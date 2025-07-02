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
        $msg = $modelUser->deleteOneUserById($id);
        if(!$user) {
            http_response_code(204);
            require './view/page/usernotdeleted.php';
            exit;
        }

        require './view/user/userdeleted.php';
    }
}