<?php

try
{   
    //conection a MySQL
$bdd = new PDO('mysql:host=localhost:3306;dbname=foot2;charset=utf8', 'root', '');
}
catch(exeption $e)
{
    //en cas d'erreur , on affiche un message et on arrete tout 
    die('Erreur : ' . $e->getMessage());
}


//recupere le contenu de la table user
$reponse = $bdd->query('SELECT * FROM user');

//on affiche chaque entée 
while ($donnees = $reponse->fetch())
{
?>
    <p>
        <stong>USER</strong> :<?php echo $donnees['nom_user'];?> <br />
        l'indentifiant est : <?php echo $donnees['id_user']; ?> <br />
        email : <?php echo $donnees['email_user']; ?> <br />
        niveau de droit : <?php echo $donnees['niveau_de_droit'] ; ?>
    </p>
    <?php
 }

 $reponse -> closeCursor();
