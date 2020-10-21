<?php

dirname(__DIR__) . '/';
require_once (dirname(__DIR__) . "/class/player/Player.php");
require_once (dirname(__DIR__) . "/class/pays/Pays.php");

$player = new Player();
$pays = new Pays();

/* display user list for manage roles
*/
function displayEachUserCard(array $user, string $lawLevel) : void
{
$username = ucfirst($user['nom_user']);

echo "
    <ul style='padding:5px;justify-content:space-around;
        list-style-type:none;width:50%;display:inline-flex;
        align-items:center;box-shadow:0 0 12px #ccc;margin:0 0 10px 0;
        border-radius:5px'
    >
        <h3 style='width:100px' >{$username}</h3>
        <li style='width:100px' >{$user['email_user']}</li>
        <li style='width:100px;font-style:italic' >{$lawLevel}</li>";

        if( intval($user['id_user']) !== 0)
        {
            echo "<form style='width:max-content'action='/user/admin/delete.php?id={$user['id_user']}' method='post'>
                    <button type='submit'>Supprimer</button>
                </form>";

            echo "<form style='width:max-content;'action='/user/admin/edit.php?id={$user['id_user']}' method='post'>
                    <button type='submit'>Modifier</button>
                </form>";
        }
echo "</ul> ";

}

function displayPermission(array $permissions) : void
{
    foreach ($permissions as $key => $permission)
    {
        $ucIntitule = ucfirst($permission['INTITULE_DROIT']);
        echo "<option value='{$permission['NIVEAU_DROIT']}'>{$ucIntitule}</option>";
    }
}

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
                        "<form action='delete.php' method='post' name='suppr' >
                            <input type='hidden' name='id' value='".$values['ID_JOUEUR']."'>
                            <button name='delete' value=1 id='suppr' >supprimer</button>
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
function regexNom($inputNom)
{

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
function regexPrenom($inputPrenom)
{

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


/**
 * verifie si out les champs sont remplis
 * 
 * @param int
 * 
 * @param string
 */
function checkInputInscription(int $idpays, string $nom, string $prenom, string $date)
{

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
 

/**
 * si un post est emis et que le button update est activé:
 * on appel la method update
 * 
 * @param object 
 */
function change($player)
{
    
    if(count($_POST) > 0 && isset($_POST["update"])){

        $player->update($value['ID_JOUEUR']);
    }
}


/**
 * quand le bouton update est active il renvoie sur la page d'inscription et modification avec le nom préremplie
 */
function showNameWhenUpdate()
{
  
        if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);

        foreach($req as $key => $value){
            echo $value["NOM_JOUEUR"];
        }
    }

}

/**
 * quand le bouton update est active il renvoie sur la page d'inscription et modification avec le prénom préremplie
 */
function showSurnameWhenUpdate()
{

    if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);

        foreach($req as $key => $value){
            echo $value["PRENOM_JOUEUR"];
        }
    }
}


/**
 * quand le bouton update est active il renvoie sur la page d'inscription et modification avec la date de naissance préremplie
 */
function showDateWhenUpdate()
{

    if(count($_POST) > 0 && isset($_POST["update"]) == 1 ){

        $update = new Player();
        $req = $update->checkInBdd($_GET["id"]);
    
        foreach($req as $key => $value){
            echo $value["DATE_NAISSANCE_JOUEUR"];
        }
    }
}


/**
 * ajoute un bouton modifier et supprimer a tout les joueurs trouvé 
 * 
 * @param object
 */
function updateAndDeleteForAll($poster,$update)
{

    if($poster){
            
        //affichage des recherche
        $value = display($poster);
        
        //suppression joueur 
        //suppr($delete);
        
        //update du joueur
        change($update);

    }

    if(!isset($value)){

        return;
    }   

    for($i=0; $i<count($value) ;$i++){

        echo $value[$i];
    }
        

    if(!isset($value["ID_JOUEUR"])){

    return;
    }
}

/**
 * si le bouton update est activé on rajoute "et modifiez" dans la page
 */
function displayUpdate()
{

    if(isset($_POST["update"]) == 1 ){

        echo " et modifiez";
    }
}
