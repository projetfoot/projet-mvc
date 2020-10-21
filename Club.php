<?php

require dirname(ROOT) . "/model/Database.php"; 

class Club extends Database{

    private $idClub;
    private $idPays;
    private $nomClub;

    public function showAll()
    {
        $sql = 'SELECT * FROM club ORDER BY id_club';
        $query = $this->pdo->query($sql);
        return $query->fetchAll();
    }

    public function add($idClub, $idPays, $nomClub)
    {
        $sql = "INSERT INTO contrat (ID_PAYS,ID_CLUB,NOM_CLUB) values(:ID_PAYS, :ID_CLUB, :NOM_CLUB)";
        $query = $this->pdo->prepare($sql);
        $exec = $query->execute([
            "ID_PAYS" => $idPays,
            "ID_CLUB" => $idClub, 
            "NOM_CLUB" => $nomClub,
            ]);
            return $exec;
    }

    public function update($idPays, $idClub, $nomClub){

        $sql = "UPDATE contrat 
                SET ID_PAYS = :ID_PAYS,
                    NOM_CLUB = :NOM_CLUB
                WHERE ID_CLUB = :ID_CLUB";

        $query = $this->pdo->prepare($sql);

        return $query->execute([
            ":ID_PAYS" => $idPays,
            ":ID_CLUB" => $idClub, 
            ":NOM_CLUB" => $nomClub,
            ]);
    }


    public function read($idClub)
    {
        $sql = "SELECT * FROM club where ID_CLUB = :ID_CLUB";
        $query = $this ->pdo->prepare($sql);
        $exec = $query->execute([
            "ID_CLUB" =>$idClub
            ]);
        return $query->fetch();
    }

    
    public function delete($idClub){
        $sql = "DELETE FROM club  WHERE ID_CLUB = :ID_CLUB";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            "ID_CLUB" =>$idClub
            ]);
       
    }

   
}
