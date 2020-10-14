<?php

require_once ("../classes/Player.php");
$player = new Player();

/**
 * affiche le nom prenom ou pays dans la recherche 
 */
function display($player){
    if(count($_POST) > 0 && isset($_POST['sub'])){

        $req = $player->poster( $_POST["snom"],$_POST["sprenom"],$_POST["spays"]);

        foreach($req as $key => $value){
            
           echo  "<p> <strong>nom: </strong>" . $value["NOM_JOUEUR"] . "<br>" .
            "<strong>prenom: </strong> " . $value["PRENOM_JOUEUR"] . "<br>" . 
            "<strong>pays: </strong> " . $value["ACRO_PAYS"] .  "</p>" ;
           echo "<input type='hidden' name='id' value='".$value['ID_JOUEUR']."'>";
        }
    }
}


/* var_dump(display($player));
die(); */

function suppr($player){


    if(count($_POST) > 0 && isset($_POST["delete"])){
        Player::delete($_POST["id"]);
    }
}
 