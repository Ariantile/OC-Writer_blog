<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;
use App\Validator\Validator;

class AdminUserController extends AdminAppController
{
    public function index()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {
            
            if (isset($_GET['cp'])){
                $cp = $_GET['cp'];
            } else {
                $cp = 1;
            }

            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
            
            $users = App::getInstance()->getTable('User')->paginateUsers($cp);
            $this->render('admin.users.index', compact('users', 'msg'));
        } else {
            $this->notAuthorized();
        }
    }
    
    public function edit()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {
            
            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
            
            $error = false;
            
            $userTable = App::getInstance()->getTable('User');
            $user = $userTable->findOne($_GET['id']);

            if (!empty($_POST)) {

                $username = strip_tags($_POST['username']);
                
                if ($_POST['username'] !== $user->username) {
                    $validator = new Validator;
                    
                    $post_array = array(
                        ['type' => 'username', 'field' => $username]
                    );
                    
                    $errors_msgs = $validator->validateForm($post_array);
                } else {
                    $errors_msgs == false;
                }

                if ($errors_msgs == false) {
                    if ($this->checkToken() == false) {
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/admin/user/edit/' . $_GET['id'] . '');
                    } else {
                        
                        $result = $userTable->update($_GET['id'], [
                            'username' => $username,
                            'type'     => $_POST['type'],
                            'status'   => $_POST['status']
                        ]);
                        if($result){
                            $_SESSION['form_errors'] = array();
                            $_SESSION['flash'] = 'Utilisateur modifié avec succès.';
                            header('Location: /writer/web/admin/users/1');
                        }
                    } 
                } else {
                    $error = true;
                }
                
                $user = $userTable->findOne($_GET['id']);
                $form = new BootstrapForm($_POST);
                
            } else {
                $form = new BootstrapForm($user);
            }

            if ($user === false)
            {
                $this->notFound();
            }

            $form = new BootstrapForm($user);

            $token = $this->formToken();

            $this->render('admin.users.edit', compact('form', 'token', 'user'));
            
        } else {
            $this->notAuthorized();
        }
    }
}
