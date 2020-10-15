<?php

class User {
    private $db;
    private $id_user;
    private $nom_user;
    private $email_user;
    private $mdp_user;
    private $niveau_de_droit;

    function __construct(array $params=[]) {
        try
        {   
         //connexion a MySQL
            $this->db = new PDO('mysql:host=localhost:3306;dbname=foot2;charset=utf8', 'root', '');
            foreach($params  as $key => $value){
                $this->$key = $value;
            }
        }
        catch(exeption $e)
        {
            //en cas d'erreur , on affiche un message et on arrete tout 
            $this->db= false;
        }
    }

    function save(){

        $sql = "SELECT * FROM user WHERE id_user = :id_user ";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':id_user', $this->id_user);
        $sth->execute();
        
        if($sth->fetch()) {
            $this->update();
        }
        else {
            $this->insert();
        }
    }

    function update(){

    ;
        $sql = "UPDATE user SET nom_user = :nom_user, email_user = :email_user,
          niveau_de_droit = :niveau_de_droit  WHERE id_user = :id_user ";
          $sth = $this->db->prepare($sql);
          $sth->bindParam(':id_user',$this->id_user);
          $sth->bindParam(':nom_user', $this->nom_user);
          $sth->bindParam(':email_user', $this->email_user);
          $sth->bindParam(':niveau_de_droit', $this->niveau_de_droit);

          $sth->execute();
    }

    function insert(){
        $sth = $this->db->prepare("INSERT INTO user (nom_user, email_user, niveau_de_droit) 
        VALUE(:nom_user, :email_user , :niveau_de_droit)"); 

         $sth->bindParam(':nom_user', $this->nom_user);
         $sth->bindParam(':email_user', $this->email_user);
         $sth->bindParam(':niveau_de_droit', $this->niveau_de_droit);

         
print_r($sth);

          $sth->execute();
    }
    static function search(array $params){

        $user1 = new User();
        $sql = "SELECT * FROM user WHERE ";
        $tabParams = [];

        foreach($params  as $key => $value) {
            $tabParams[]=trim($key). " LIKE  :" .trim($key) ;
        }
        $sql .= implode(" AND ",$tabParams);
        $sth = $user1->db->prepare($sql);

        foreach($params  as $key => $value) {
            $value="%".$value."%";
            $sth->bindValue(':'.$key, $value);
        }

        $sth->execute();
        return $sth->fetchAll();
    }

}
