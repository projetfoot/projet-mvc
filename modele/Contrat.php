<?php

require ROOT . "/modele/Database.php"; 

class Contrat extends Database{

    private $idContrat;
    private $idJoueur;
    private $idClub;
    private $nomContrat;

    public function showAll()
    {
        $sql = 'SELECT * FROM contrat ORDER BY id_contrat DESC';
        $query = $this->pdo->query($sql);
        return $query->fetchAll();
    }

    public function add($idJoueur, $idClub, $nomContrat)
    {
        $sql = "INSERT INTO contrat (ID_JOUEUR,ID_CLUB,NOM_CONTRAT) values(:ID_JOUEUR, :ID_CLUB, :NOM_CONTRAT)";
        $query = $this->pdo->prepare($sql);
        $exec = $query->execute([
            "ID_JOUEUR" => $idJoueur,
            "ID_CLUB" => $idClub, 
            "NOM_CONTRAT" => $nomContrat
            ]);
            return $exec;
    }

    public function update($idJoueur, $idClub, $nomContrat, $idContrat){

        $sql = "UPDATE contrat 
                SET ID_JOUEUR = :ID_JOUEUR,
                    ID_CLUB = :ID_CLUB,
                    NOM_CONTRAT = :NOM_CONTRAT
                WHERE ID_CONTRAT = :ID_CONTRAT";

        $query = $this->pdo->prepare($sql);

        return $query->execute([
            ":ID_JOUEUR" => $idJoueur,
            ":ID_CLUB" => $idClub, 
            ":NOM_CONTRAT" => $nomContrat, 
            ":ID_CONTRAT" => $idContrat,
            ]);
    }


    public function read($idContrat)
    {
        $sql = "SELECT * FROM contrat where ID_CONTRAT = :ID_CONTRAT";
        $query = $this ->pdo->prepare($sql);
        $exec = $query->execute([
            "ID_CONTRAT" =>$idContrat
            ]);
        return $query->fetch();
    }

    
    public function delete($idContrat){
        $sql = "DELETE FROM contrat  WHERE ID_CONTRAT = :ID_CONTRAT";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            "ID_CONTRAT" =>$idContrat
            ]);
       
    }

}
