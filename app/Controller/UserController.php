<?php

namespace App\Controller;

use Core\Form\BootstrapForm;
use Core\Auth\DatabaseAuth;
use \App;

class UserController extends AppController
{
    public function login()
    {
        $error = false;
        
        $app = App::getInstance();

        if(!empty($_POST))
        {
            $auth = new DatabaseAuth($app->getDb());
            if ($auth->login($_POST['username'], $_POST['password'])) {
                header('Location: /writer/web/admin/articles/1');
            } else {
                $error = true;
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'error'));
    }
}
