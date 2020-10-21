<?php 

require_once dirname(dirname(__DIR__)) . "/class/contrat/Contrat.php"; 

$idContrat = null; 

if (!empty($_GET['idContrat'])) 
{ 
    $idContrat = $_REQUEST['idContrat']; 
} 
    

$contrat = new Contrat();
$data = $contrat->read($idContrat);
$idJoueur = $data['ID_JOUEUR'];
$idClub = $data['ID_CLUB'];
$nomContrat = $data['NOM_CONTRAT'];


  
?>

<?php require_once dirname(dirname(__DIR__)) .'/partials/header.php'; ?> 

<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3>Edition</h3>
        </div>
            
        <div class="form-horizontal" >
            <div class="control-group">
                <label class="control-label">Id Joueur : </label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['ID_JOUEUR']; ?>
                    </label>
                </div>  
            </div>

            <div class="control-group">
                <label class="control-label">Id Club :</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['ID_CLUB']; ?>
                    </label>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Nom Contrat :</label>
                <div class="controls">
                        <label class="checkbox">
                            <?php echo $data['NOM_CONTRAT']; ?>
                        </label>
                </div>
            </div>

            <div class="form-actions">
                <a class="btn" href="index.php">Back</a>
            </div>
        </div>

    </div>
</div>

<?php require_once dirname(dirname(__DIR__)) .'/partials/footer.php'; ?>