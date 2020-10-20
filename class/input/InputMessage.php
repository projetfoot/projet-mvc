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
                    array_push($list, self::$key());
                }
            }
        }
        return $list;
    } 

    
    private static function name() : string
    {
        return 'Veuillez vérifier le champ nom';
    }

    private static function mail() : string
    {
        return 'Veuillez vérifier le champ email';
    }

    private static function password() : string
    {
        return 'Veuillez vérifier le champ mot de passe';
    }

    private static function equal() : string
    {
        return 'Veuillez vérifier que les champs mot de passe soient identiques';
    }
}