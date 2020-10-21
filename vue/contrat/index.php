<?php 

session_start();

require_once dirname(dirname(__DIR__)) . "/class/contrat/Contrat.php"; 

$contrat = new Contrat();

$all = $contrat->showAll();
?>

<?php require_once dirname(dirname(__DIR__)) .'/partials/header.php'; ?> 

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
           
        <?php endforeach ?>

        <div>
            <?php if (isset($_SESSION["success"]))
                {
                    echo $_SESSION["success"];
                    $_SESSION["success"] = null;
                } ?>
        </div>
<?php require_once dirname(dirname(__DIR__)) .'/partials/footer.php'; ?>
