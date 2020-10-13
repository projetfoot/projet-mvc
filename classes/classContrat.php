<?php
include_once ("class.php");
class Contrat extends Connect
{
    private string $id;
    private string $idJoueur;
    private string $idClub;
    private string $nom;

    public function __construct($i='', $ij='', $ic='', $n=''){
        $this->id=$i;
        $this->idJoueur=$ij;
        $this->idClub=$ic;
        $this->nom=$n;
        parent::__construct();
    }

    /**
    * sort tout les matricule 
    * @param string
    */
    public function checkInBdd(string $post){
        $result = $this->bdd->prepare('SELECT ID_JOUEUR FROM `joueur` ');
        $result->execute();
        $req = $result->fetchAll;
        return $req;
    }

    /**
     * insere les données du formulaire dans la bdd
     * @return bool
     */
    private function insert(){   
        $result = $this->bdd->prepare("INSERT INTO `contrat` (ID_CONTRAT , ID_JOUEUR, ID_CLUB, NOM_CONTRAT) VALUES (:id, :idj, :idc, :nom) ");
        $result->bindParam(':id', $this->id);
        $result->bindParam(':idj', $this->idJoueur);
        $result->bindParam(':idc', $this->idClub);
        $result->bindParam(':nom', $this->nom);

        $req = $result->execute(); 
        echo "on est passé par l'insert";
        return $req; 
    }

    /**
    * update un joueur si le id est deja prit(il faut tout repréciser)
    */
    private function update(){  
        $result = $this->bdd->prepare('UPDATE `contrat` SET ID_CONTRAT = :id, ID_JOUEUR = :idj, ID_CLUB = :idc, NOM_CONTRAT = :nom  WHERE ID_CONTRAT  = :id');
        $result->bindParam(':id', $this->id);
        $result->bindParam(':idj', $this->idJoueur);
        $result->bindParam(':idc', $this->idClub);
        $result->bindParam(':nom', $this->nom);
        $req = $result->execute();
        echo "on est passé par l'update";
    }

   /**
    * en fonction du matricule rentré cette fonction renvoie soit vers l'insert si aucun matricule soit vers l'update
    */
    public function write(){
        $result = $this->bdd->prepare("SELECT * FROM `contrat` WHERE ID_CONTRAT = :id");
        $result->bindParam(':id', $this->id);
        $result->execute(); 
        $req = $result->fetch();
        if(!$req){
            $this->insert();
        }else {
           $this->update();
        }
    }
}