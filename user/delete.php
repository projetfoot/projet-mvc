<?php 
require_once '../lib/functions.php';
require_once ROOT .'class/session/Session.php'; 
require_once ROOT .'class/model/UserModel.php'; 
require_once ROOT .'class/Tool.php'; 


$session = new Session();
$userModel = new UserModel();

$id = intval(strip_tags($_GET['id']));

$data = $userModel->findOneBy('user','id_user', $id);

if(count($data) > 0 )
{
    
    $delete = $userModel->deleteOneBy('user','id_user', $id);
    $delete 
    ? $session->set('alertUserRoles', 'success', "Utilisateur : <strong>{$data['nom_user']}</strong> supprimé") 
    : $session->set('alertUserRoles', 'error', "Une erreur est survenue lors de la suppression"); 

    Tool::redirectTo('/user/role/show.php');
}else{
    $session->set('alertUserRoles', 'error', "Désolé mais cet utilisateur n'existe pas"); 
    Tool::redirectTo('/user/role/show.php');
}