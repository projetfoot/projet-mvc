<?php
    require_once dirname(dirname(__DIR__)) . '/lib/functions.php';
    require_once ROOT .'class/Tool.php'; 
    require_once ROOT .'class/input/Input.php'; 
    require_once ROOT .'class/model/UserModel.php'; 
    require_once ROOT .'class/session/Session.php'; 


   if(isset($_POST) && !empty($_POST))
   {
      $input = new Input($_POST, 'alertUser');
      $error = $input->error();
      
      if( !in_array(false , $error['cleans']) && !in_array(false, $error['emptys']) )
      {
         $session = new Session();
         $userModel = new UserModel();

         if( $data = $userModel->ifExist( $_POST['mail']) )
         {     
            if( password_verify($_POST['password'], $data['password_user']) )
            {
               $session->set('alertUser', 'succes', "Vous êtes connectés {$data['nom_user']}");
               $session->set('_userStart', null, intval($data['id_user']));
               Tool::redirectTo('/vue/user/home.php');
            }else{
               $session->set('alertUser', 'error', "Veuillez vérifier vos identifiants");
            }
         
         }else{
            $session->set('alertUser', 'error', "Désolé mais ce compte n'existe pas");
         }
      }
   }
?>
<h1>Se connecter</h1>

<form method="post">
    <input type="email" name="mail" placeholder="@Email">
    <input type="password" name="password" placeholder="Entrez un mot de passe">
    <button type="submit">Se connecter</button>
    <a href="/vue/user/signup.php">Creer un compter</a>
</form>

<?php (new Session())->display('alertUser') ?>
