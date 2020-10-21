 <?php 

    require_once dirname(dirname(__DIR__)) . "/class/contrat/Contrat.php"; 
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)){ //on initialise nos messages d'erreurs; 
        $contrat = new Contrat();
        $idJoueurError = ''; $idClubError=''; $nomContratError='';  // on recupère nos valeurs 
        $idJoueur = htmlentities(trim($_POST['idJoueur']));
        $idClub=htmlentities(trim($_POST['idClub'])); 
        $nomContrat = htmlentities(trim($_POST['nomContrat'])); // on vérifie nos champs 
        $valid = true; 
        $regex="/[0-9]/"; 
        $result = null;

        if (empty($idJoueur)) { 

            $idJoueurError = 'Please enter id Joueur'; 
            $valid = false; 

        }else if(!preg_match($regex,$idJoueur)){ 

            $idJoueurError = 'Please enter Id Joueur'; 
            $valid = false;
        }
            
        if (empty($idClub)) { 

            $idClubError = 'Please enter id Club'; 
            $valid = false; 

        }else if(!preg_match($regex,$idClub)){ 

            $idClubError = 'Please enter Id Club'; 
            $valid = false; 
        } 

        if (empty($nomContrat)) {

             $nomContratError = 'Please enter nom contrat'; 
                $valid = false; 

        }else if (!preg_match("/^[a-zA-Z ]*$/",$nomContrat)) { 

            $nomContratError = "Only letters and white space allowed"; 
            $valid = false; 
        }

        if($valid){
            $add = $contrat->add($idJoueur, $idClub, $nomContrat);

            if ($add){
                $result = 'Contrat crée';
            }else{
                $result = 'Une erreur est survenue';
            }
        }
    }
?>

<?php require_once dirname(dirname(__DIR__)) .'/partials/header.php'; ?> 

<div class="container">
    <div class="row">
        <h3>Ajouter un contrat</h3>
    </div>

    <form method="post" action="add.php">
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
            <input type="submit" class="btn btn-success" name="submit" value="submit">
            <a class="btn" href="index.php">Retour</a>
        </div>

    </form>
        <?= $result ?? "" ?>
</div>

<?php require_once dirname(dirname(__DIR__)) .'/partials/footer.php'; ?>