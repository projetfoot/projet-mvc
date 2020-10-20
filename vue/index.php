<?php 

session_start();

define("ROOT", dirname(__DIR__));
require ROOT . "/modele/Contrat.php"; 

$contrat = new Contrat();

$all = $contrat->showAll();
var_dump($_POST);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Crud en php</title>
         <link href="./css/bootstrap.min.css" rel="stylesheet">  
    </head>

    <body>
        <div class="container">
            <div class="row">
                <h2>Gestion des Contrat</h2>
            </div>
            <div class="row">
                <form method="post">
                    <label>Nom du contrat</label>
                    <input type="text" name="nomContrat"/>
                    <input type ="submit" value="Recherche"/>
                </form>
                <br/><br/>
            </div>
            <div class="row">
                <a href="add.php" class="btn btn-success">Ajouter un contrat</a>
                <br/><br/>
                
            <?php foreach ($all as $key => $value) : ?>

                <div style="margin-bottom : 10px;">
                    <?= $value['ID_JOUEUR'] ?>
                    <?= $value['ID_CLUB'] ?>
                    <?= $value['NOM_CONTRAT'] ?>
                </div>
                
                <a class="btn" href="read.php?idContrat=<?= $value['ID_CONTRAT'] ?>">Read</a>
                <a class="btn btn-success" href="update.php?idContrat=<?= $value['ID_CONTRAT'] ?> ">Update</a>
                <a class="btn btn-danger" onclick="window.confirm('Êtes-vous sur de vouloir supprimer ce contrat ?')" href="delete.php?idContrat=<?= $value['ID_CONTRAT'] ?>  ">Delete</a>
                <?php if (isset($_SESSION["success"]))
                {
                    echo $_SESSION["success"];
                } ?>
            <?php endforeach ?>


    </body>
</html>