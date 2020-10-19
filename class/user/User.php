<?php

require_once ROOT .'class/model/UserModel.php'; 

class User
{
    private string $id;

    private string $name;

    private string $email;

    private string $password;

    private int $lawLevel = 0;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }    

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Get the value of lawLevel
     */ 
    public function getLawLevel()
    {
        return $this->lawLevel;
    }

    /**
     * Set the value of lawLevel
     *
     * @return  self
     */ 
    public function setLawLevel($lawLevel)
    {
        $this->lawLevel = $lawLevel;

        return $this;
    }

    /**
     *Edit user
     */
    public function edit (string $name,string $mail, int $id)
    {   
        $this->setName($name);
        $this->setEmail($mail);
        
        (new UserModel())->update($this, intval($id));
        (new Session())->set('alertUser', 'success', 'Modification enregistré');
        Tool::redirectTo('/user/profil.php');
    }

    /**
     * Unauthorize user email edition if email already exist
     */
    public function ifEmailExistWhenUserEdit(string $mail, string $currentUserData) : void
    {
        $emailExist = (new UserModel())->findOneBy('user', 'email_user', $mail);
        
        if($emailExist && $emailExist['email_user'] !== $currentUserData)
        {
            (new Session())->set('alertUser', 'error', 'Cet adresse mail est déjà utilisé');
            Tool::redirectTo('/user/profil.php');
        }
    }

    /**
     * Get error
     */
    public function getError(array $post, string $currentPassword)
    {
        $inputValidator = new InputValidator();
        $inputMessage = new InputMessage();
        $session =  new Session();
        $tool = new Tool();
        $inputPass = $post['editPassword'] ?? '';
        $inputNewPass = $post['newPassword'] ?? '';
        $confirmNewPass = $post['confirmNewPassword'] ?? '';

        $error = [];

        // var_dump($inputPass, $currentPassword);

        if( empty($inputPass) )
        {
            $session->set('alertUserPass', 'error', $inputMessage->password());
            $error[] = false;
        }

        if( !password_verify($inputPass, $currentPassword) )
        {   
            $session->set('alertUserPass', 'error', $inputMessage->badPassword());
            $error[] = false;
        }

        if( empty($inputNewPass) )
        {
            $session->set('alertUserPass', 'error', $inputMessage->newPassword());
            $error[] = false;
        }

        if( !$inputValidator->password($inputNewPass) )
        {   
            $session->set('alertUserPass', 'error', $inputMessage->newPasswordVerify());
            $error[] = false;
        }

      
        if( $inputNewPass !== $confirmNewPass )
        {   
            $session->set('alertUserPass', 'error', $inputMessage->equal());
            $error[] = false;
        }
        
        return $error;
    }

    /**
     * Edit user pass
     */
    public function editPass(array $post, string $currentPassword)
    {
        $session = new Session();
        $error = $this->getError($post, $currentPassword);
        $id = $session->get('_userStart');
        $userRepo = new UserModel();
        $inputMessage = new InputMessage();

        if(!in_array(false, $error))
        {
            $this->setPassword($post['newPassword']);

            if( $userRepo->updatePass($this, $id))
            {
                $session->set('alertUserPass','success', $inputMessage->passwordChanged());
            }else{
                $session->set('alertUserPass','error', 'désolé une erreur est survenue' );
            }
        }
    }

    /**
     * Display all users
     */
    public function displayAll()
    {
        $usersRepo = (new UserModel())->findAll('user');

        foreach ($usersRepo as $key => $user) {

            $lawLevel = intval($user['niveau_de_droit']);
            $law = $this->lawLevel($lawLevel);

            displayEachUserCard($user, $law);
        }
    }

    private function lawLevel(int $level) 
    {   
        $law = null;

        if($level ===  0)
        {
            $law =  "Basic";
        }

        if($level ===  65535 )
        {
            $law =  "Super-Admin";
        }
        return $law;
    }
}