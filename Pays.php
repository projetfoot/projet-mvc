<?php


$idPays=filter_input(INPUT_GET,'idPays');
$acroPays=filter_input(INPUT_GET,'acroPays');
$nomPays=filter_input(INPUT_GET,'nomPays');

$pays2 = new Pays;
$pays2->setIdP($idPays);
$pays2->setAcroP($acroPays);
$pays2->setNameP($nomPays);

$pays2 -> readPays($idPays);

//$pays2->createOrUpdate();
//$pays2->deletePays($idPays);
var_dump($pays2);


class Pays{
    private $db;
    private int $idPays;
    private string $acroPays;
    private string $nomPays;
   
    

    public function __construct()
    {
        $this->db=new PDO ('mysql:host=localhost;dbname=projetfoot;charset=utf8','root','');
        
    }
    
    public function readPays(int $idPays)
    {
        $resultat = $this->db->prepare('SELECT * FROM pays WHERE ID_PAYS = :idPays');
        $resultat->bindParam(":idPays", $idPays);
        $resultat->execute();
        $element=$resultat->fetch();
        //$this->id_pays=$element['ID_PAYS'];
        $this->acroPays=$element['ACRO_PAYS'];
        $this->nomPays=$element['NOM_PAYS'];
    }

    public function deletePays(int $idPays)
    {
        $resultat = $this->db->prepare('DELETE FROM pays WHERE ID_PAYS = :idPays');
        $resultat->bindParam(":idPays", $idPays);
        $resultat->execute();
    }



function createOrUpdate() {

    $sql= 'SELECT `ID_PAYS` FROM `pays` WHERE ID_PAYS = :idPays';
    
    $prep = $this->db->prepare($sql);
    $prep->bindParam(':idPays' , $this->idPays);
    $prep->execute();

    if($prep->fetch()) { 

        $sql = 'UPDATE `pays` SET `ACRO_PAYS`=:acroPays,`NOM_PAYS`=:nomPays WHERE ID_PAYS = :idPays';
       
    } else {

        $sql = 'INSERT INTO `pays` (ID_PAYS, ACRO_PAYS , NOM_PAYS) VALUES (:idPays,:acroPays,:nomPays)';

    }

    $prep = $this->db->prepare($sql);
    $prep->bindParam(':idPays' , $this->idPays);
    $prep->bindParam(':acroPays' , $this->acroPays);
    $prep->bindParam(':nomPays' , $this->nomPays);
    $prep->execute();
    //print_r($prep);

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
?>