<?php 
    define('ROOT', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);
    

    //varible pour la recherche 
    $snom = filter_input(INPUT_POST,'snom');
    $sprenom = filter_input(INPUT_POST,'sprenom');
    $spays = filter_input(INPUT_POST,'spays');

    
    //appel de notre fichier classPlayer
    require_once (dirname(ROOT) . DS ."classes/classPlayer.php");
    require_once (dirname(ROOT) . DS ."libs/functions.php");

    //etablissement d'une nouvelle connexion
    $dbh = new Connect;

    //si la page compte au moin un post la condition s'execute
    if(count($_POST) > 0){
        

        if($_POST['sub'] == 2){
            $poster = new Player(); 
        } 

        if($_POST["delete"] == 1 ){
            $delete = new Player();
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
    
    <h2>recherchez un joueur</h2>
    <form  method="post">
        <label for="nom">nom</label>
        <input type="text" name="snom">
        <label for="prenom">prenom</label>
        <input type="text" name="sprenom">
        <label for="pays">pays</label>
        <input type="text" name="spays">  
        <button type="submit" name="sub" value="2">envoyer</button>
        <?php
            //affichage des recherche
             display($poster);
        ?>
    </form>
    <br>
    <a href="inscriptionUpdate.php">inscire ou modifier un joueur</a>
</body>
</html>