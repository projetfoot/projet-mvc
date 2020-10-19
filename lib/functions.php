<?php

define('ROOT', dirname(__DIR__) . '/');

/**
 * display user list for manage roles
 */
function displayEachUserCard(array $user, string $lawLevel) : void
{       
    $username = ucfirst($user['nom_user']);
    echo "
        <ul style='padding:0;justify-content:space-around;
            list-style-type:none;width:50%;display:inline-flex;
            align-items:center;box-shadow:0 0 12px #ccc;margin:0 0 10px 0;
            border-radius:5px'
        >
            <h3 style='width:150px' >{$username}</h3>
            <li style='width:150px' >{$user['email_user']}</li>
            <li style='width:150px;font-style:italic' >{$lawLevel}</li>";
            
            if( intval($user['id_user']) !== 0)
            {
                echo "<form style='width:100px;'action='/user/delete.php?id={$user['id_user']}' method='post'>
                <button type='submit'>Supprimer</button>
                </form>";
            }

    echo "</ul> ";
}