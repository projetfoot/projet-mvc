<?php

require_once '../lib/functions.php';
require_once ROOT .'class/input/Input.php'; 
require_once ROOT .'class/model/UserModel.php'; 
require_once ROOT .'class/session/Session.php'; 

$session = new Session();
$id = $session->get('_userStart');

$userModel = new UserModel();
$data = $userModel->findOneBy('user','id_user',$id);

if(isset($_POST) && !empty($_POST))
{
    $input = new Input($_POST, 'alertUser');
    $error = $input->error();

    if( !in_array(false , $error['cleans']) && !in_array(false, $error['emptys']) )
    {   
        var_dump($error['cleans'], $error['emptys']);

        if( password_verify($_POST['password'], $data['password_user']) )
        {

        }else{
            $session->set('alertUser', 'error', "Veuillez vérifier vos identifiants");
        }
    }

}

?>


<?php require_once '../lib/functions.php'; ?>
<?php require_once ROOT .'partials/header.php';?>

<h1>Profil</h1>

<form method="post">
    <input type="text" name="name" value="<?= $data['nom_user'] ?>" placeholder="Email">
    <input type="email" name="mail" value="<?= $data['email_user'] ?>" placeholder="Email">
    <input type="password" name="password" placeholder="Entrez un mot de passe">
    <input type="password" name="confirmPass" placeholder="Confirmer mot de passe">
    <button type="submit">Enregistrer</button>
</form>

