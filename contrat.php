<?php 

    define('ROOT', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);

    $id = filter_input(INPUT_POST, 'id');
    $idJoueur = filter_input(INPUT_POST, 'idj');
    $idClub = filter_input(INPUT_POST, 'idc');
    $nom = filter_input(INPUT_POST, 'nom');

    

    require_once (ROOT . DS .'classContrat.php');
    var_dump(ROOT . DS .'classContrat.php');

    //si la page compte au moin un post la condition s'execute
    if(count($_POST) > 0){
        $bdd = new Contrat($id,$idJoueur,$idClub,$nom);
        $bdd-> write();
    }
    
    //si $dbh est un objet on echo reussite
    if($bdd){
        echo 'connexion reussite';
    } else
        echo "erreur";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Créez un contrat pour un joueur</h1>
    <form  method='post'>
        <label for="id">id du contrat</label>
        <input type="text" name="id"> 
        <label for="idj">id du joueur</label>
        <input type="text" name="idj" >
        <label for="idc">id du club</label>
        <input type="text" name="idc" >
        <label for="nom">nom du contrat</label>
        <input type="text" name="nom"> 
        <button type="submit">envoyer</button>
    </form>
    <a href="index.php">retour</a>
    </body>
</html>