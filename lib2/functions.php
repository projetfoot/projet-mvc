<?php

require_once ("../classes/Player.php");
$player = new Player();

/**
 * affiche le nom prenom ou pays dans la recherche 
 */
function display($player){
    //si au moin un POST est passe et que le button avec la valeur sub est activer alors on execute la recherche
    if(count($_POST) > 0 && isset($_POST['sub'])){

        $req = $player->poster( $_POST["snom"],$_POST["sprenom"],$_POST["spays"]);

        foreach($req as $key => $value){
            
           echo  "<p> <strong>nom: </strong>" . $value["NOM_JOUEUR"] . "<br>" .
            "<strong>prenom: </strong> " . $value["PRENOM_JOUEUR"] . "<br>" . 
            "<strong>pays: </strong> " . $value["ACRO_PAYS"] .  "</p>" ;
            //on met dans une variable cachée notre id du joueur pour pouvoir interagir avec lui
           echo "<input type='hidden' name='id' value='".$value['ID_JOUEUR']."'>";
        }
    }
}



function suppr($player){

    //si au moin un POST est passe et que le button avec la valeur delete est activer alors on execute la suppression par id
    //avec la fonction static delete 
    //on appellera la fonction suppr dans le html

    if(count($_POST) > 0 && isset($_POST["delete"])){
        
        Player::delete($_POST["id"]);
    }
}
 