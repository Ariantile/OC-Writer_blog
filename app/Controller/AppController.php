<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;
use \DateTime;

class AppController extends Controller
{
    protected $template = 'layout';
    
    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
    }
    
        
    public function notFound()
    {
        header('HTTP/1.1 404 Not Found');
            
        $error_msg = 'La ressource demandée n\'est pas disponible.';
            
        $this->render('error', compact('error_msg'));
            
        die();
    }
    
    public function notAuthorized()
    {
        header('HTTP/1.1 403 Forbidden');
            
        $error_msg = 'Vous n\'êtes pas autorisé à accéder à cette page.';
            
        $this->render('error', compact('error_msg'));
            
        die();
    }
    
    public function badRequest()
    {
        header('HTTP/1.1 400 Bad Request');
            
        $error_msg = 'Requête incorrecte.';
            
        $this->render('error', compact('error_msg'));
            
        die();
    }
    
    public function formToken()
    {
        $now = new DateTime();
        
        if (!isset($_SESSION['token']) || !isset($_SESSION['tokentime']) || $_SESSION['tokentime']->diff($now)->format('%i') > 10 ) {
            $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
            $token_time = new DateTime();

            $_SESSION['token'] = $token;
            $_SESSION['tokentime'] = $token_time;
            return $token;
        } else {
            $token = $_SESSION['token'];
            return $token;
        }
    }
    
    public function currentPage()
    {
        if (isset($_SESSION['reading'])) {
            unset($_SESSION['reading']);
        }
        
        $cur = $_GET['id'];
        $_SESSION['reading'] = $_GET['id'];
        return $cur;
    }
    
    public function checkToken()
    {
        if (isset($_SESSION['token']) AND isset($_POST['token']) AND !empty($_SESSION['token']) AND !empty($_POST['token'])) {
            if ($_SESSION['token'] == $_POST['token']) {  
                return true;
            }
        } else {
            return false;
        }
    }
}
