<?php
require_once dirname( dirname(__DIR__)) . '/lib/functions.php';
require_once ROOT .'class/input/Input.php'; 
require_once ROOT .'class/model/UserModel.php'; 
require_once ROOT .'class/session/Session.php'; 
require_once ROOT .'class/Tool.php'; 


$session = new Session();
$session->get('_userStart') ?? $session->ifNotConnected();
$userModel = new UserModel();

$id = intval(strip_tags($_GET['id']));

$data = $userModel->findOneBy('user','id_user', $id);

if(isset($_POST['permission']))
{
    (new User())->updateLawLevel($id, intval($_POST['permission']));
}

$permissions = $userModel->findAll('droit');
?>

<?php require_once ROOT .'partials/header.php';?>

<form action="" method="post">
    <h1>Editer l'utilisateur <?= ucfirst($data['nom_user'])?></h1>

    <p>Nom : <?= ucfirst($data['nom_user']) ?></p>
    <p>Email : <?= ucfirst($data['email_user']) ?></p>

    <select style='width:150px' name='permission' id='permission'>
        <option value=''>Level</option>
        <?php displayPermission($permissions) ?>
    </select>
    <button type="submit">Sauvegarder</button>
</form>

<?php (new Session())->display('alertUserRolesEdition') ?>
