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

    public function createUser(string $pseudo, string $email, string $password) : bool {
        $sql = "INSERT INTO user (pseudo, email, password, created_at) VALUES (:pseudo, :email, :password, NOW())";
        $query = $this->getDb()->prepare($sql);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        return $query->execute();
    }

    public function searchUser(string $email) : ?User {
        $sql = "SELECT email, password FROM user WHERE email=:email";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $query->rowCount() > 0 ? new User($user) : null;
    }

    public function deleteOneUserById(int $id) : bool {
        $sql = "DELETE from user WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->rowCount();
    }

    public function updateOneUserById(int $id, string $pseudo, string $email, string $password) : bool {
        $sql = "UPDATE user 
                SET pseudo=:pseudo, email=:email, password=:password 
                WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $query->execute();
    }
}