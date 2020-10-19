<?php

    define('ROOT', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);

    //creation des varibales filtrées
    $idpays = filter_input(INPUT_POST,'pays', FILTER_VALIDATE_INT);
    $nom = filter_input(INPUT_POST,'nom' );
    $prenom = filter_input(INPUT_POST,'prenom');
    $date = filter_input(INPUT_POST,'date');

    require_once (dirname(ROOT) . DS ."classes/Player.php");
    require_once (dirname(ROOT) . DS ."lib2/functions.php");
    require_once (dirname(ROOT) . DS ."classes/Pays.php");


    //si ce qui est entrée dans nom et prenom n'est pas un chiffre alors on insert
    if( regexNom($nom) && regexPrenom($prenom) == true){
        checkInputInscription($idpays,$nom,$prenom,$date);
    }

    elseif (empty($idpays) || empty($nom) || empty($prenom) || empty($date)) {

        echo "remplissez tout les champs";
    } 
     else{

        echo "n'entrez pas de chiffre dans le nom et le prenom";
     }

?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>inscrivez </h1>
    <form  method='post'>
        <select name="pays">
        <?php
            
            $listePays = $pays->readPays();

            //recup les valeurs de readPays pour la liste des pays
            foreach($listePays as $key => $value){
                echo "<option value=" . $value["ID_PAYS"]. ">". $value["NOM_PAYS"] . "</option>";
            }
            
        ?>
        </select>
        <label for="nom"></label>
        <input type="text" name="nom"  placeholder="nom..." value="<?=showNameWhenUpdate()?>" required>
        <label for="prenom"></label>
        <input type="text" name="prenom" value="<?=showSurnameWhenUpdate()?>" required > 
        <label for="date">date de naissance</label>
        <input type="date" name="date" placeholder="date" value="<?=showDateWhenUpdate()?>" required> 
        <button type="submit" name="sub" value="1">envoyer</button>
        <br>
        <a href="rechercheJoueur.php">retour sur la recherche</a>
        <br>
    </form>

</body>
</html>