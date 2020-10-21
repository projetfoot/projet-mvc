<?php 

session_start();

define("ROOT", dirname(__DIR__));

require dirname(ROOT) . "/class/club/Club.php"; 

$club = new Club();

$all = $club->showAll();

header("Content-Type:application/json");

echo json_encode($all);
?>
