<?php

require_once dirname(__DIR__) . '/input/InputValidator.php';
require_once dirname(__DIR__) . '/input/InputMessage.php';
require_once dirname(__DIR__) . '/session/Session.php';

class Input
{
    private array $post;
    private array $cleans;
    private array $emptys;

    public function __construct(array $post, string $sessionSection)
    {   
        $this->post = $post ;
        $this->validator = new InputValidator();
        $this->message = new inputMessage();
        $this->session = new Session();

        $this->cleans = $this->clean();
        $this->emptys = $this->empty();
        $info = $this->message->get( $this->ifIsGoodAndFull() );
        $this->session->setSessionList($sessionSection, $info);
    }

    /**
     * verify if each input is not empty
     */
    private function empty()
    {
        $error = [];

        foreach ($this->post as $key => $value) {

            !empty($value) ? $error[$key] = true : $error[$key] = false  ;
        }
        
        return $error;
    }

    /**
     * verify if each input is conform
     */
    private function clean()
    {   
        $name = $this->post['mail'];
        $pass = $this->post['password'];
        $confirmPass = $this->post['confirmPass'];

        $error = [];
        
        $error['mail'] = filter_var($name, FILTER_VALIDATE_EMAIL);
        $error['password'] = $this->validator->password($pass);
        $error['equal'] = $pass === $confirmPass ? true : false;

        return $error;
    }

    /**
     * 
     */
    private function ifIsGoodAndFull() : array
    {
        $arrays = [ $this->cleans, $this->emptys ];
        $error = [];

        foreach ($arrays as $key => $array) {

            foreach ($array as $key => $value) {
    
                if($value === false)
                {
                    $error[$key] = $value;
                }
            }
        }
        return $error;
    }

    public function error() : array
    {
        return [
            'cleans' => $this->cleans,
            'emptys' => $this->emptys,
        ];
    }

}