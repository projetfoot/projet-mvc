<?php
    define('ROOT', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);

    //creation des varibales filtrées
    $id = filter_input(INPUT_POST,'id');
    $pays = filter_input(INPUT_POST,'pays');
    $nom = filter_input(INPUT_POST,'nom');
    $prenom = filter_input(INPUT_POST,'prenom');
    $date = filter_input(INPUT_POST,'date');

    require_once (dirname(ROOT) . DS ."classes/classPlayer.php");
    require_once (dirname(ROOT) . DS ."lib/functions.php");
    
    if(count($_POST) > 0 ){
        if($_POST['sub'] == 1) {
            //ajout des paramètres dans le constructeur
            $bdd = new Player($pays,$nom,$prenom,$date);
            //appel de la méthode
            $bdd->write(); 
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>inscrivez un joueur dans la bdd.</h1>
    <p> Si l'id entrée correspond a un joueur veillez réentrer tout les champs avec le champs que vous voulez changer </p>
    <form  method='post'>
        <label for="pays">pays</label>
        <input type="text" name="pays" >
        <label for="nom">nom</label>
        <input type="text" name="nom" >
        <label for="prenom">prenom</label>
        <input type="text" name="prenom"> 
        <label for="date">date de naissance</label>
        <input type="date" name="date"> 
        <button type="submit" name="sub" value="1">envoyer</button>
        <br>
        <a href="rechercheJoueur.php">retour sur la recherche</a>
    </form>

</body>
</html>