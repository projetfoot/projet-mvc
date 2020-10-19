<?php 

var_dump($_POST["id"]);

$delete = null;

require_once ("../classes/Player.php");
require_once ("../lib2/functions.php");

$delete = new Player;


$id = $_POST["id"];
$req = Player::delete($id);

var_dump($req);
if($req){

    session_start();
    $_SESSION['suppr'] = "suppresion effectuée";
    header("location:rechercheJoueur.php");

} else {

    "erreur!";
}
