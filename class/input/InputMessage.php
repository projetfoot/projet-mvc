<?php

class InputMessage
{
    /**
     * Display errors if exist
     */
    public static function get (array $array) : array
    {   
        $list = [] ;
        
        if( in_array(false, $array) )
        {
            unset($array['confirmPass']);

            foreach ($array as $key => $value) {

                if( $value === false)
                {   
                    $list[$key] = self::$key();
                }
            }
        }
        return $list;
    } 

    
    public static function name() : string
    {
        return 'Veuillez vérifier le champ nom';
    }

    public static function mail() : string
    {
        return 'Veuillez vérifier le champ email';
    }

    public static function equal() : string
    {
        return 'Veuillez vérifier que les champs mot de passe soient identiques';
    }
    
    public static function password() : string
    {
        return 'Veuillez vérifier le champ mot de passe';
    }
    
    public static function badPassword() : string
    {
        return 'Mot de passe incorrect';
    }

    public static function editPassword() : string
    {
        return 'Veuillez entrer le mot de passe courant';
    }

    public static function newPassword() : string
    {
        return 'Veuillez entrer un nouveau mot de passe valide';
    }

    public static function newPasswordVerify() : string
    {
        return 'Veuillez vérifier le champ nouveau mot de passe';
    }

    public static function confirmNewPassword() : string
    {
        return 'Veuillez confirmer le nouveau mot de passe';
    }

    public static function passwordChanged() : string
    {
        return 'Le mot de passe a été changé';
    }
}