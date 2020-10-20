<?php

require_once dirname(dirname(dirname(__DIR__))) . '/lib/functions.php';
require_once ROOT .'class/input/Input.php'; 
require_once ROOT .'class/model/UserModel.php'; 
require_once ROOT .'class/session/Session.php'; 
require_once ROOT .'class/Tool.php'; 

$session = new Session();
$id = $session->get('_userStart');

$userModel = new UserModel();
$data = $userModel->findOneBy('user','id_user',$id);

$user = new User();
?>

<?php require_once ROOT .'partials/header.php';?>

<h1>Gérer les utilisateurs</h1>

<?php $user->displayAll(); ?>

<?php (new Session())->display('alertUserRoles') ?>
