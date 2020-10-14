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
     */
    public function set(string $section, string $type , string $message) : void
    {
        $_SESSION[$section][$type] = $message;
    }

     /**
     * Get $key in current session
     */
    public function get(string $key)
    {
        return $_SESSION[$key];
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
}