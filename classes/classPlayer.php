<?php

require_once ("class.php");
/**
* nouvelle class player qui est la fille de la classe mère "Connect"
*/
class Player extends Connect
{
    private string $id = '';
    private $country = '';
    private $name= '';
    private $surname = '';
    private $birth = '';

    /**
     * creation d'un constructor pour mon nouveau joueur 
     * @param string
     */
    public function __construct( $i='', string $c='', string $n='', string $s='', string $b=''){
        $this->id=$i;
        $this->country=$c;
        $this->name=$n;
        $this->surname=$s;
        $this->birth=$b;
        parent::__construct();
    }

    /**
     * sort tout les matricule 
     * @param string
     */
    public function checkInBdd(string $post){
        $result = $this->bdd->prepare(
            "SELECT ID_JOUEUR FROM `joueur` "
        );
        $result->execute();
        $req = $result->fetchAll;
        return $req;
    }

    /**
     * insere les données du formulaire dans la bdd
     * @return bool
     */
    private function insert(){   
        $result = $this->bdd->prepare(
            "INSERT INTO `joueur` (ID_JOUEUR, ID_PAYS, NOM_JOUEUR, PRENOM_JOUEUR, DATE_NAISSANCE_JOUEUR) 
            VALUES (:id, :country, :name, :surname, :birth) "
        );
        $result->bindParam(':id', $this->id);
        $result->bindParam(':country', $this->country);
        $result->bindParam(':name', $this->name);
        $result->bindParam(':surname', $this->surname);
        $result->bindParam(':birth', $this->birth);

        $req = $result->execute(); 
        echo "on est passé par l'insert";
        return $req; 
    }

    /**
     * update un joueur si le id est deja prit(il faut tout repréciser)
     */
    private function update(){  
        $result = $this->bdd->prepare(
            "UPDATE `joueur` 
            SET ID_JOUEUR = :id, 
            ID_PAYS = :codepays, 
            NOM_JOUEUR = :nom, 
            PRENOM_JOUEUR = :prenom  
            WHERE ID_JOUEUR  = :id"
    );
        $result->bindParam(':id', $this->id);
        $result->bindParam(':codepays', $this->country);
        $result->bindParam(':nom', $this->name);
        $result->bindParam(':prenom', $this->surname);
        $req = $result->execute();
        echo "on est passé par l'update";
    }
    
    /**
     * en fonction du matricule rentré cette fonction renvoie soit vers l'insert si aucun matricule soit vers l'update
     */
    public function write(){
        $result = $this->bdd->prepare(
            "SELECT * FROM `joueur`
            WHERE ID_JOUEUR = :id"
        );
        $result->bindParam(':id', $this->id);
        $result->execute(); 
        $req = $result->fetch();
        if(!$req){
            $this->insert();
        }else {
           $this->update();
        }
    }

    /**
     * l'utilisateur rentre un nom ou un prenom ou un pays et on le trouve dans la bdd
     * @param string
     * @return array
     */
    public function poster( $snom, $sprenom, $spays){
        $sql = "SELECT * FROM `joueur` 
                INNER JOIN pays 
                on joueur.ID_PAYS = pays.ID_PAYS 
                WHERE NOM_JOUEUR like :nom 
                AND PRENOM_JOUEUR like :prenom
                AND (pays.ID_PAYS like :pays 
                OR pays.ACRO_PAYS like :pays 
                OR pays.NOM_PAYS like :pays)";

       $result  = $this->bdd->prepare($sql);

       //concaténation pour le LIKE)
       $snom="%".$snom."%";
       $sprenom="%".$sprenom."%";
       $spays="%".$spays."%";

       $result->bindParam(":nom", $snom);
       $result->bindParam(":prenom", $sprenom);
       $result->bindParam(":pays", $spays);

       $result->execute(); 

       $req = $result->fetchAll();
       echo 'recherche...';
       return $req;
   }

   /**
    * supprime le joueur et son contrat
    */
   private function delete(){
       $result = $this->bdd->prepare("DELETE FROM `joueur` WHERE ID_JOUEUR = :id");
       $result->bindParam(":id", $this->id);
       $req = $result->execute();
       echo "joueur supprimé";
   }

   public function varDump($variable)
   {
       echo '<pre style=background-color:#333' . ';width:50%' . ';color:#fff>' . print_r($variable, true) . '</pre>';
   }
}


