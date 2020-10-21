<?php 

    require_once dirname(dirname(__DIR__)) . "/class/contrat/Contrat.php"; 
 
    $idContrat=0; 
    if(!empty($_GET['idContrat'])){ 
        $idContrat=$_REQUEST['idContrat']; 
    } 
    $contrat = new Contrat();
    $contrat->delete($idContrat);
    session_start();
    $_SESSION["success"] = "Contrat Supprimé ! ";
    header("Location: index.php");

 