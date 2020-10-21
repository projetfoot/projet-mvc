<?php 


$delete = null;


require_once ("../../class/player/Player.php");
require_once ("../../lib/functions.php");

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
