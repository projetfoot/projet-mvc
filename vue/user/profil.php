<?php

require_once ROOT . 'lib/functions.php';
require_once ROOT .'class/input/Input.php'; 
require_once ROOT .'class/model/UserModel.php'; 
require_once ROOT .'class/session/Session.php'; 
require_once ROOT .'class/Tool.php'; 

$session = new Session();
$id = $session->get('_userStart');
$id ?? $session->ifNotConnected();

$userModel = new UserModel();
$data = $userModel->findOneBy('user','id_user',$id);

$user = new User();

if(isset($_POST["editPassword"]))
{
    $user->editPass($_POST, $data['password_user']);
}

if(isset($_POST['mail']) && !empty($_POST['mail']))
{
    $input = new Input($_POST, 'alertUser');
    $error = $input->error();

    if( !in_array(false , $error['cleans']) && !in_array(false, $error['emptys']) )
    {   
        if( password_verify($_POST['password'], $data['password_user']) )
        {   
            $user->ifEmailExistWhenUserEdit( $_POST['mail'], $data['email_user'] );
            $user->edit($_POST['name'], $_POST['mail'], $data['id_user']);
        }else{
            $session->set('alertUser', 'error', "Mot de passe incorrect");
        }
    }
}
?>

<<<<<<< HEAD:vue/user/profil.php
>>>>>>> Groupe-1:user/profil.php
<?php require_once ROOT .'partials/header.php';?>

<h1>Profil</h1>

<form method="post">
    <input type="text" name="name" value="<?= $data['nom_user'] ?>" placeholder="Nom">
    <input type="email" name="mail" value="<?= $data['email_user'] ?>" placeholder="Email">
    <input type="password" name="password" placeholder="Entrez un mot de passe">
    <button type="submit">Enregistrer</button>
    <a href="/user/profil.php?editPass=true">Modifier mot de passe</a>
</form>

<?php (new Session())->display('alertUser') ?>

<?php if (isset($_GET['editPass']) ) : ?>

    <h2>Modifier mot de passe</h2>

    <form style="margin-top:20px" method="post">
        <input type="password" name="editPassword" placeholder="Mot de passe actuel">
        <input type="password" name="newPassword" placeholder="Nouveau mot de passe">
        <input type="password" name="confirmNewPassword" placeholder="Confirmer le nouveau mot de passe">
        <button type="submit">Enregistrer nouveau mot de passe</button>
    </form>

    <?php (new Session())->display('alertUserPass') ?>

<?php endif ?>