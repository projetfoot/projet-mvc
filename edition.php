<?php

require "user.php";
$User =
new User(array(
    "id_user" =>"" ,
    "nom_user" => 'francois',
    "email_user"=> 'fg@hotmail.fr',
    "niveau_de_droit"=> 15 ));
    $User->save();
    var_dump($User);

?>

<form action="" method="post">
<input type="text" name="auteur" value=""/>
<input type="text" name="prix" value=""/>
<input type="hidden" name="" value="'"/>
<input type="submit"/>';
