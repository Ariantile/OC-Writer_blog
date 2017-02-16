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
            $this->forbidden();
        }
    }
}
