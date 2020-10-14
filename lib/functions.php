<?php

require_once ("../classes/classPlayer.php");
$poster = new Player;

function display($poster){
    if(count($_POST) > 0 && $_POST['sub'] == 2){
        $req = $poster->poster( $_POST["snom"],$_POST["sprenom"],$_POST["spays"]);
        foreach($req as $key => $value){
           echo  "<p> <strong>nom: </strong>" . $value["NOM_JOUEUR"] . "<br>" . "<strong>prenom: </strong> " . $value["PRENOM_JOUEUR"] . "<br>" . "<strong>pays: </strong> " . $value["ACRO_PAYS"] .  "</p>";
        }
        
    }
}