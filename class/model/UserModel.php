<?php

require_once ROOT .'class/model/Model.php'; 

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
        var_dump($user);

        return $query->execute([
            'nom_user' => $user->getName(),
            'email_user' => $user->getEmail(),
            'password_user' => $user->getPassword(),
            'niveau_de_droit' => $user->getLawLevel(),
        ]);
    }
}