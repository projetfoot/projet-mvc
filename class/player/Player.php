<?php


require_once dirname(__DIR__) . "/model/Model.php";

/**
* nouvelle class player qui est la fille de la classe mère "Connect"
*/
class Player extends Model
{
    private  $id = '';
    private int $country = -1;
    private string $name= '';
    private string $surname = '';
    private string $birth = '';

    /**
    * creation d'un constructor pour mon nouveau joueur 
    * @param string
    */
    public function __construct(int $c=-1, string $n='', string $s='', string $b=''){
        $this->country=$c;
        $this->name=$n;
        $this->surname=$s;
        $this->birth=$b;
        parent::__construct();
    }

    /**
    * sort tout les nom et prenom 
    * @param string
    */
    public function checkInBdd(string $post){
        $result = $this->pdo->prepare(
            "SELECT * FROM joueur WHERE ID_JOUEUR = :id"
        );
        $result->execute([
            "id" => $post
        ]);
        $req = $result->fetchAll();
        return $req;
    }

    /**
    * insere les données du formulaire dans la bdd
    * @return bool
    */
    private function insert(){   
        $result = $this->pdo->prepare(
            "INSERT INTO `joueur` (ID_PAYS, NOM_JOUEUR, PRENOM_JOUEUR, DATE_NAISSANCE_JOUEUR) 
            VALUES ( :country, :name, :surname, :birth) "
        );
        $result->bindParam(':country', $this->country);
        $result->bindParam(':name', $this->name);
        $result->bindParam(':surname', $this->surname);
        $result->bindParam(':birth', $this->birth);

        $req = $result->execute(); 
        return $req; 
    }

    /**
    * update un joueur si le id est deja prit(il faut tout repréciser)
    */
    public function update(){  
        $result = $this->pdo->prepare(
            "UPDATE `joueur` 
            SET ID_PAYS = :codepays, 
            NOM_JOUEUR = :nom, 
            PRENOM_JOUEUR = :prenom  
            WHERE NOM_JOUEUR = :nom
            AND PRENOM_JOUEUR = :prenom 
            ");

        $result->bindParam(':codepays', $this->country);
        $result->bindParam(':nom', $this->name);
        $result->bindParam(':prenom', $this->surname);
        $req = $result->execute();
    }
    
    /**
    * en fonction du matricule rentré cette fonction renvoie soit vers l'insert si aucun matricule soit vers l'update
    */
    public function write(){
        $result = $this->pdo->prepare(
            "SELECT * FROM `joueur`
            WHERE NOM_JOUEUR = :nom
            AND 
            PRENOM_JOUEUR = :prenom
            ");
        $result->bindParam(':nom', $this->name);
        $result->bindParam(':prenom', $this->surname);
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
    public  function poster( $snom, $sprenom, $spays){
        $sql = "SELECT * FROM `joueur` 
                INNER JOIN pays 
                on joueur.ID_PAYS = pays.ID_PAYS 
                WHERE NOM_JOUEUR like :nom 
                AND PRENOM_JOUEUR like :prenom
                AND (pays.ID_PAYS like :pays 
                OR pays.ACRO_PAYS like :pays 
                OR pays.NOM_PAYS like :pays)";

        $result  = $this->pdo->prepare($sql);

       //concaténation pour le LIKE)
       $snom="%".$snom."%";
       $sprenom="%".$sprenom."%";
       $spays="%".$spays."%";

       $result->bindParam(":nom", $snom);
       $result->bindParam(":prenom", $sprenom);
       $result->bindParam(":pays", $spays);

       $result->execute(); 

       $req = $result->fetchAll();
 
       return $req;
   }

   /**
    * supprime le joueur et son contrat
    *
    * @param string 
    */
   public static  function delete($id){

       $player = new Player();
       $result = $player->pdo->prepare("DELETE FROM `joueur` WHERE ID_JOUEUR = :id");
       $result->bindParam(":id", $id);
       
      return  $result->execute();

    }

}


