<?php

require_once ("../classes/Player.php");
require_once ("../classes/Pays.php");

$player = new Player();
$pays = new Pays();


/**
* affiche le nom,prenom et pays dans la recherche 
*/
function display($player){

    //si au moin un POST est passe et que le button avec la valeur sub est activer alors on execute la recherche
    if(count($_POST) > 0 && isset($_POST['sub'])){

        $req = $player->poster( $_POST["snom"],$_POST["sprenom"],$_POST["spays"]);
        $result= [];

        foreach($req as $key => $values){
            
            $result[] = 
                        "<p> <strong>nom: </strong>" . $values["NOM_JOUEUR"] . "<br>" .
                        "<strong>prenom: </strong> " . $values["PRENOM_JOUEUR"] . "<br>" . 
                        "<strong>pays: </strong> " . $values["ACRO_PAYS"] .  "</p>" .
                        "<form action='delete.php' method='post' name='suppr'>
                            <input type='hidden' name='id' value='".$values['ID_JOUEUR']."'>
                            <button name='delete' value=1 >supprimer</button>
                        </form> ".
                        "<form action='inscription.php?id=".$values["ID_JOUEUR"]."' method='post'> 
                            <button name='update' value=1>modifier</button>
                        </form>"; 
        }
        return $result;
    }
}



/**
* applique un Regex sur l'input nom
* 
* @param string 
* 
* @return bool si ça correspond
*/
function regexNom($inputNom){
    $subject = $inputNom;
    
    $regex = "/[a-zA-Z]/";
    $regex1 = "/[0-9]/";
   /*  $regex2 = '/[0-9&"(à_)=}\]@^\\`|^{$ù*!:;,¤£µ%§\/.?+*]/'; */

    if(preg_match($regex, $subject) && !preg_match($regex1, $subject)/*  &&  !preg_match($regex2, $subject) */){
        
        return true;

    } else {

        return false;
    }
}

/**
* applique un Regex sur l'input prenom
* 
* @param string 
* 
* @return bool si ça correspond
*/
function regexPrenom($inputPrenom){
    $subject = $inputPrenom;
    
    $regex = "/[a-zA-Z]/";
    $regex1 = "/[0-9]/";
    /* $regex2 = '/[0-9&"(à_)=}\]@\^\\`|\^{\$ù\*!:;,¤£µ%§\/.?\+\*]/'; */

    if(preg_match($regex, $subject) && !preg_match($regex1, $subject) /* && !preg_match($regex2, $subject) */){
        
        return true;

    } else {

        return false;
    }
}


function checkInputInscription(int $idpays, string $nom, string $prenom, string $date){

    if(count($_POST) > 0 && !empty($idpays) && !empty($nom) && !empty($prenom) && !empty($date)){

        if($_POST['sub'] == 1) {
            //ajout des paramètres dans le constructeur
            $bdd = new Player($idpays,$nom,$prenom,$date);

            //appel de la méthode
            $bdd->write(); 
        }
    } else {
        echo "remplissez tout les champs";
        
    }
}
 

function change($player){
    
    if(count($_POST) > 0 && isset($_POST["update"])){

        $player->update($value['ID_JOUEUR']);
    }
}

function showNameWhenUpdate(){
  
        if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);

        foreach($req as $key => $value){
            echo $value["NOM_JOUEUR"];
        }
    }

}

function showSurnameWhenUpdate(){

    if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);

        foreach($req as $key => $value){
            echo $value["PRENOM_JOUEUR"];
        }
    }
}


function showDateWhenUpdate(){

    if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);
    
        foreach($req as $key => $value){
            echo $value["DATE_NAISSANCE_JOUEUR"];
        }
    }
}
