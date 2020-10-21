<?php 
    require_once dirname(dirname(__DIR__)) . '/lib/functions.php';
    require_once ROOT .'class/session/Session.php'; 
    require_once ROOT .'class/model/UserModel.php'; 


$session = new Session();
$userModel = new UserModel();

$id = $session->get('_userStart');
$id ?? $session->ifNotConnected();
$name = $userModel->findName($id)[0];

?>

<?php require_once ROOT .'partials/header.php'; ?> 

<h1>Accueil</h1>

<h2>Bienvenue <span style="text-decoration:underline"><?= ucfirst($name) ?></span></h2>

<?php (new Session())->display('alertUser') ?>

<?php require_once ROOT .'partials/footer.php'; ?>