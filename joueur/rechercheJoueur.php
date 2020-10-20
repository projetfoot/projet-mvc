<?php 
    define('ROOT', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);


    //varible pour la recherche 
    $snom = filter_input(INPUT_POST,'snom');
    $sprenom = filter_input(INPUT_POST,'sprenom');
    $spays = filter_input(INPUT_POST,'spays');
    $poster = null;
    $update = null;
    
    //appel de notre fichier classPlayer
    require_once (dirname(ROOT) . DS ."classes/Player.php");
    require_once (dirname(ROOT) . DS ."lib2/functions.php");

    //etablissement d'une nouvelle connexion
    $dbh = new Connect();

    //si la page compte au moin un post la condition s'execute
    
    if(count($_POST) > 0){
        
        if(isset($_POST['sub'])){

            $poster = new Player(); 
        } 

        if(isset($_POST["delete"])){

            $delete = new Player();
        }

        if(isset($_POST["update"])){

            $update = new Player();
        }
    } 

    if(isset($_SESSION['suppr'])){
        echo $_SESSION['suppr'];
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
            <a href="inscription.php">inscrire un joueur</a>
        </form>
        <div class="form">
            <!-- ajoute un bouton supprimer et ajouter pour tout les joueurs trouvé -->
            <?php updateAndDeleteForAll($poster,$update)?>
        </div>
    
    <script src="../script/app.js"></script>   
    </body>
</html>

