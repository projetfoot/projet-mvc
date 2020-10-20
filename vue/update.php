<?php 
    session_start();
     define("ROOT", dirname(__DIR__));
     require ROOT . "/modele/Contrat.php"; 
      
    $idContrat = null; 
    
    if ( !empty($_GET['idContrat'])) 
    { 
        $idContrat = $_REQUEST['idContrat']; 
    } 
        
    $contrat = new Contrat();


    $data = $contrat->read($idContrat);

    $idJoueur = $data['ID_JOUEUR'];
    $idClub = $data['ID_CLUB'];
    $nomContrat = $data['NOM_CONTRAT'];
    $update = null;
    
    if( count($_POST) > 0)
    {

        $update = $contrat->update($_POST['idJoueur'], $_POST['idClub'], $_POST['nomContrat'], $idContrat);
        
        if ($update)
            {
                $_SESSION["success_update"] = "Contrat Modifié ! ";
            }
            
        if (!$update)
            {
                echo"Erreur";  
            }
                
                header("Location: update.php?idContrat=$idContrat");
            }


   
    if ( null==$idContrat ) 
    { 
         header("Location: index.php"); 
    } 

     
     ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contrat</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">       
    </head>

    <body>

<div class="container">
    <div class="row">
        <h3>Modifier un contrat</h3>
    </div>

    <form method="post" action="update.php?idContrat=<?php echo $idContrat ;?>">
        <div class="control-group <?php echo !empty($idJoueurError)?'error':'';?>">
            <label class="control-label">Id Joueur</label>

            <div class="controls">
                <input name="idJoueur" type="number"  placeholder="id Joueur" value="<?php echo !empty($idJoueur)?$idJoueur:'';?>">
                <?php if (!empty($idJoueurError)): ?>
                    <span class="help-inline"><?php echo $idJoueurError;?></span>
                <?php endif; ?>
            </div>
        </div>
  
        <div class="control-group<?php echo !empty($idClubError)?'error':'';?>">
            <label class="control-label">Id Club</label>
                   
            <div class="controls">
                <input type="number" name="idClub" value="<?php echo !empty($idClub)?$idClub:''; ?>">
                <?php if(!empty($idClubError)):?>
                    <span class="help-inline"><?php echo $idClubError ;?></span>
                <?php endif;?>
            </div>
        </div>
        
        <div class="control-group<?php echo !empty($nomContratError)?'error':'';?>">
            <label class="control-label">nom Contrat</label>
                   
            <div class="controls">
                <input type="text" name="nomContrat" value="<?php echo !empty($nomContrat)?$nomContrat:''; ?>">
                <?php if(!empty($nomContratError)):?>
                    <span class="help-inline"><?php echo $nomContratError ;?></span>
                <?php endif;?>
            </div>
        </div>

        <div class="form-actions">
            <input type="submit" class="btn btn-success" name="submit" value="Update">
            <a class="btn" href="index.php">Retour</a>
        </div>

    </form>

    <?php 
    
    if (isset($_SESSION["success_update"]))
        {
            echo $_SESSION["success_update"];
        } 
    ?>
</div>
        
</body>
</html>