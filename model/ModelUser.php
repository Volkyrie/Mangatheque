<?php 
class ModelUser extends Model {
    public function getUsers() : array {
        $sql = "SELECT id, pseudo, email, password, created_at FROM user";
        $query = $this->getDb()->query($sql);

        $arrayUser = [];
        while($user = $query->fetch(PDO::FETCH_ASSOC)) {
            $arrayUser[] = new User($user);
        }

        return $arrayUser;
    }

    public function getOneUserById(int $id) : ?User {
        $sql = "SELECT id, pseudo, email, password, created_at FROM user WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user ? new User($user) : NULL;
    }

    public function deleteOneUserById(int $id) {
        $sql = "DELETE from user WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return "User was successfully deleted";
    }
}