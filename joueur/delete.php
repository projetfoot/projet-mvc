<?php 

var_dump($_POST["id"]);

$delete = null;

require_once ("../class/Player.php");
require_once ("../joueurLib/functions.php");

$delete = new Player;


$id = $_POST["id"];
$req = Player::delete($id);

if($req){

    session_start();
    $_SESSION['suppr'] = "suppresion effectuée";
    header("location:rechercheJoueur.php");

} else {

    "erreur!";
}
