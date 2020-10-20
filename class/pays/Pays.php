<?php 

class Pays extends Model{
    private int $idPays;
    private string $acroPays;
    private string $nomPays;
   
    
    public function readPays()
    {
        $resultat = $this->pdo->prepare('SELECT * FROM `pays` ORDER BY `pays`.`ACRO_PAYS` ASC ');
        $resultat->execute();
        $elements = $resultat->fetchAll();
        
        return $elements;
    }

    public function  getIdP() : int {
        return $this->idPays;
    }

    public function  getAcroP() : string {
        return $this->acroPays;
    }

    public function getNameP() : string {
        return $this->nomPays;
    }

    public function setIdP(int $idP){
        $this->idPays = $idP;
    }

    public function setAcroP(string $acroP){
        $this->acroPays = $acroP;
    }

    public function setNameP(string $nameP){
        $this->nomPays = $nameP;
    }

}