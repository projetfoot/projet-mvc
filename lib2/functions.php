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

        foreach($req as $key => $value){
            
           echo  "<p> <strong>nom: </strong>" . $value["NOM_JOUEUR"] . "<br>" .
            "<strong>prenom: </strong> " . $value["PRENOM_JOUEUR"] . "<br>" . 
            "<strong>pays: </strong> " . $value["ACRO_PAYS"] .  "</p>" ;
            //on met dans une variable cachée notre id du joueur pour pouvoir interagir avec lui
           echo "<input type='hidden' name='id' value='".$value['ID_JOUEUR']."'>";
        }
    }
}


/**
 * supprime le joueur de la base de donnée et __destruct l'objet
 * @param object player
 */
function suppr($player){

    //si au moin un POST est passe et que le button avec la valeur delete est activer alors on execute la suppression par id
    //on appellera la fonction suppr dans le html qui appel la fonction static delete dans la class Joueur

    if(count($_POST) > 0 && isset($_POST["delete"])){

        Player::delete($_POST["id"]);
    }
}

/* function showPays($pays){

    $req= $pays->readPays();
    foreach($req as $key => $value){
        echo $id = $value["ID_PAYS"];
    }
}  */


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
    if(preg_match($regex, $subject) && !preg_match($regex1, $subject)){
        
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
    if(preg_match($regex, $subject) && !preg_match($regex1, $subject)){
        
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
 