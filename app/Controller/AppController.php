<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller
{
    protected $template = 'layout';
    
    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
    }
}
