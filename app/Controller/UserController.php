<?php

namespace App\Controller;

use Core\Form\BootstrapForm;
use Core\Auth\DatabaseAuth;
use \App;
use App\Validator\Validator;
use App\Mailer\Mailer;

class UserController extends AppController
{
    public function register()
    {
        if (isset($_SESSION['flash']))
        {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        
        $error = false;
        
        if(!empty($_POST))
        {
            $validator = new Validator;
            
            $username       = strip_tags($_POST['username']);
            $email          = strip_tags($_POST['email']);
            $emailConfirm   = strip_tags($_POST['emailConfirm']);
            
            $post_array = array(
                ['type' => 'username', 'field' => $username],
                ['type' => 'email', 'field' => $email, 'field_conf' => $emailConfirm],
                ['type' => 'password', 'field' => $_POST['password'], 'field_conf' => $_POST['passwordConfirm']],
            );
            
            $errors_msgs = $validator->validateForm($post_array);
            
            if ($errors_msgs == false) {
                
                if ($this->checkToken() == false){
                    $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                    header('Location: /writer/web/inscription');
                } else {
                    
                    $userTable = App::getInstance()->getTable('User');
                    
                    $activation = sha1(MCRYPT_DEV_URANDOM);
                    
                    $result = $userTable->create([
                        'username'   => $username,
                        'email'      => $email,
                        'password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'status'     => 'Registred',
                        'type'       => 'Member',
                        'activation' => $activation,
                        'activated'  => false
                    ]);
                    if($result) {
                        $mailer = new Mailer();
                        $type   = 'activation';
                        $mailer->sendMail($type, $activation, $email, $username);
                        $_SESSION['flash'] = 'Inscription réussi, vous recevrez un courriel d\'activation sous peu';
                        header('Location: /writer/web/login');
                    }
                }
            } else {
                $error = true;
            }
        }

        $token = $this->formToken();
        
        $form = new BootstrapForm($_POST);
        
        $this->render('users.register', compact('form', 'error', 'form_errors', 'token', 'msg'));
    }
    
    public function activate()
    {
        $code = $_GET['c'];
        $user_table =  App::getInstance()->getTable('User');
        $check_activation = $user_table->findOneActivation($code);
        
        if (empty($check_activation)) {
            $this->notFound();
        } else if($check_activation->activated == true) {
            
            $_SESSION['flash'] = 'Compte déjà actif, veuillez vous connecter';
            header('Location: /writer/web/login');
            
        } else {
            
            $result = $user_table->update($check_activation->id, [
                'status'     => 'Validated',
                'activated'  => true
            ]);
            
            if($result) {
                $_SESSION['flash'] = 'Activation réussi, veuillez vous connecter';
                header('Location: /writer/web/login');
            }
        } 
    }
    
    public function forgot()
    {
        $error = false;
        
        if(!empty($_POST))
        {
            $validator = new Validator;
            
            $post_array = array(
                ['type' => 'sendforgot', 'field' => $_POST['sendforgot']],
            );
            
            $errors_msgs = $validator->validateForm($post_array);

            if ($errors_msgs == false) {
                
                if ($this->checkToken() == false){
                    $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                    header('Location: /writer/web/oublie');
                } else {
                    $type       = 'forgot';
                    $email      = $_POST['sendforgot'];
                    
                    $forgotTable = App::getInstance()->getTable('Forgot');
                    $user        = App::getInstance()->getTable('User')->findOneByEmail($email);
                    $mailer      = new Mailer();
                    
                    $forgotcode = sha1(MCRYPT_DEV_URANDOM);
                    $user_id    = $user->id;
                    $username   = $user->username;
                    
                    $result = $forgotTable->create([
                        'user_id'    => $user_id,
                        'forgotcode' => $forgotcode
                    ]);
                    
                    $mailer->sendMail($type, $forgotcode, $email, $username);
                    
                    $_SESSION['flash'] = 'Demande enregistrée, un courriel de récupération vous sera envoyé sous peu';
                    header('Location: /writer/web/login');
                }
            } else {
                $error = true;
            }
        }
        
        $token = $this->formToken();
        
        $form = new BootstrapForm($_POST);
        
        $this->render('users.sendforgot', compact('form', 'error', 'form_errors', 'token', 'msg'));
    }
    
    public function forgotchange()
    {
        $code = $_GET['c'];
        $forgot_table =  App::getInstance()->getTable('Forgot');
        $check_forgot = $forgot_table->findOneForgot($code);
        
        if (empty($check_forgot)) {
            $this->notFound();
        } else {
            
            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
        
            $error = false;
        
            if(!empty($_POST))
            {
                $validator = new Validator;
                
                $post_array = array(
                    ['type' => 'password', 'field' => $_POST['password'], 'field_conf' => $_POST['passwordConfirm']]
                );
            
                $errors_msgs = $validator->validateForm($post_array);
                
                if (empty($errors_msgs)) {
                    
                    $user_table = App::getInstance()->getTable('User');
                    
                    $result = $user_table->update($check_forgot->user_id, [
                        'password'   => password_hash($_POST['password'], PASSWORD_DEFAULT)
                    ]);
                    
                    if($result) {
                        $forgot_table->delete($check_forgot->id);
                        $_SESSION['flash'] = 'Modification du mot de passe réussi, veuillez vous connecter';
                        header('Location: /writer/web/login');
                    }
                }
            } else {
                $error = true;
            }
            
            $token = $this->formToken();
        
            $form = new BootstrapForm($_POST);
        
            $this->render('users.forgot', compact('form', 'error', 'form_errors', 'token', 'msg'));
            
        }
        
    }
    
    public function login()
    {
        $error = false;
        
        if (isset($_SESSION['flash']))
        {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        
        $app = App::getInstance();

        if(!empty($_POST))
        {
            $auth = new DatabaseAuth($app->getDb());
            if ($auth->login($_POST['username'], $_POST['password'])) {
                header('Location: /writer/web/article/index/1');
            } else {
                $error = true;
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'error', 'msg'));
    }
    
    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        
        header('Location: /writer/web/');   
    }
    
    public function member()
    {        
        if (isset($_SESSION['type'])) {
            
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            
            $memberInfos = array('username' => $username, 'email' => $email, 'type' => $type);
            
            $this->render('users.member', compact('memberInfos'));
        } else {
            $this->notAuthorized();
        }
    }
}
