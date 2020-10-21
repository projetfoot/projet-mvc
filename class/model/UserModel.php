<?php

require_once ROOT .'class/model/Model.php'; 
require_once ROOT .'class/user/User.php'; 

class UserModel extends Model
{   
    public function ifExist(string $email) : array
    {
       return $this->findOneBy('user', 'email_user' , $email) ?: [];
    }

    public function create(User $user) : bool
    {   
        $sql = "INSERT INTO user (nom_user, email_user, password_user, niveau_de_droit )
                VALUES (:nom_user, :email_user, :password_user, :niveau_de_droit )
            ";
        
        $query = $this->pdo->prepare($sql);

        return $query->execute([
            'nom_user' => $user->getName(),
            'email_user' => $user->getEmail(),
            'password_user' => $user->getPassword(),
            'niveau_de_droit' => $user->getLawLevel(),
        ]);
    }

    public function findName($id) : array
    {
        $sql = "SELECT nom_user FROM user WHERE id_user = :id_user";

        $query = $this->pdo->prepare($sql);

        $query->execute([
            ":id_user" => $id
        ]);

        return $query->fetch();
    }

    public function update(User $user, int $id) : bool
    {
        $sql = "UPDATE user
                SET nom_user = :nom_user,
                    email_user = :email_user
                WHERE id_user = :id_user";

        $query = $this->pdo->prepare($sql);
        
        return $query->execute([
            ':nom_user' => $user->getName(),
            ':email_user' => $user->getEmail(),
            ':id_user' => $id
        ]);
    }

    public function updatePass(User $user, int $id) : bool
    {
        $sql = "UPDATE user
                SET password_user = :password_user
                WHERE id_user = :id_user";

        $query = $this->pdo->prepare($sql);
        
        return $query->execute([
            ':password_user' => $user->getPassword(),
            ':id_user' => $id
        ]);
    }

    public function updateLawLevel(User $user, int $id) : bool
    {
        $sql = "UPDATE user
                SET niveau_de_droit = :niveau_de_droit
                WHERE id_user = :id_user";

        $query = $this->pdo->prepare($sql);
        
        return $query->execute([
            ':niveau_de_droit' => $user->getLawLevel(),
            ':id_user' => $id
        ]);
    }
}