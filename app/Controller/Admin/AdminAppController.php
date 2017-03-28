<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use \Core\Auth\DatabaseAuth;
use \App;

class AdminAppController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        
        $app = App::getInstance();
        $auth = new DatabaseAuth($app->getDb());

        if (!$auth->logged())
        {
            header('HTTP/1.1 403 Forbidden');
            
            $error_msg = 'Vous n\'êtes pas autorisé à accéder à cette page.';
            
            $this->render('error', compact('error_msg'));
            
            die();
        }
    }
}
