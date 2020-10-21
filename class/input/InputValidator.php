<?php

/**
 * Validator check input values
 */
class InputValidator
{   
    /**
     * Check if value name is conform else return false
     * @param string $name It's input value
     */
    public function name(?string $name) : bool
    {   
        $regex = "/^[a-z]*$/i";

        if(!preg_match( $regex, $name) )
        {
            return false;
        }else {
            return true;
        }
    }

    /**
     * Check if value email is conform else return false
     * @param string $email It's input value
     */
    public function email(?string $email) : bool
    {
        if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
        {
            return false;
        }else {
            return true;
        }
    }

    /**
     * Check if value password is conform else return false
     * @param string $password It's input value
     */
    public function password(?string $password) : bool
    {
        // $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        
        // if( !preg_match( $regex, $password) )
        // {
        //     return false;
        // }else {
        //     return true;
        // }
        return true;
    }
}