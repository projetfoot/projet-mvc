<?php
    require_once '../lib/functions.php';
    require_once ROOT .'class/input/Input.php'; 
    require_once ROOT .'class/model/UserModel.php'; 
    require_once ROOT .'class/user/User.php'; 


    if(isset($_POST) && !empty($_POST))
    {
       $input = new Input($_POST, 'alertUser');
       $error = $input->error();
       
       if( !in_array(false , $error['cleans']) && !in_array(false, $error['emptys']) )
       {
            $userModel = new UserModel();
            $user = new User();
            $session = new Session();


            if( !$userModel->ifExist( $_POST['mail']) )
            {
                $user->setName($_POST['name']);
                $user->setEmail($_POST['mail']);
                $user->setPassword($_POST['password']);
                

                $userModel->create($user) 
                ?  $session->set('alertUser', 'success', "Le compte {$user->getEmail()} a bien été crée")
                    : $session->set('alertUser', 'error', "Une erreur est survenue lors de l'inscription")
                ;
            
            }else{
               $session->set('alertUser', 'error', "Ce compte existe déjà");
            }
       }
    }
?>

<h1>Creer un compte</h1>

<form method="post">
    <input type="text" name="name" placeholder="Nom">
    <input type="email" name="mail" placeholder="Email">
    <input type="password" name="password" placeholder="Entrez un mot de passe">
    <input type="password" name="confirmPass" placeholder="Confirmer mot de passe">
    <button type="submit">Enregistrer</button>
</form>
<a href=""></a>

<?php (new Session())->display('alertUser') ?>
