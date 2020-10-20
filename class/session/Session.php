<?php

class Session
{
    public function __construct()
    {
        $this->run();
    }

    private function run()
    {
        if(session_status() !== 2)
        {
            session_start();
        }
    }

    public function setSessionList(string $section, array $messages) : void
    {
        foreach ($messages as $key => $message) {

            $_SESSION[$section][$key] = $message;
        }
    }

    /**
     * Example : 'file','error','Error while file creation'
     * @param mixed $value
     */
    public function set(string $section , string $type = null, $value) : void
    {   
        if($type === null)
        {
            $_SESSION[$section] = $value;
            return;
        }

        $_SESSION[$section][$type] = $value;
    }

     /**
     * Get $key in current session
     */
    public function get(string $section)
    {
        return $_SESSION[$section];
    }

    public function display($section) : void
    {   
        if(!isset($_SESSION[$section]))
        {
            return ;
        }

        foreach ( $_SESSION[$section] as $key => $type) {
            echo "<li class='{$key}'>$type</li>";
        }

        $_SESSION[$section] = null;
    }

    /**
     * If user not connected return him to signin page 
     */
    public function ifNotConnected() : void
    {
        if( !isset($_SESSION['_userStart']) )
        {
            header('Location:/vue/user/signin.php');
            die();
        }
    } 
}