<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminUserController extends AdminAppController
{
    public function index()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }
            
        $users = App::getInstance()->getTable('User')->paginateUsers($cp);
        $this->render('admin.users.index', compact('users'));
    }
    
    public function edit()
    {
        $userTable = App::getInstance()->getTable('User');

        if (!empty($_POST)){
            $result = $categorieTable->update($_GET['id'], [
                'username' => $_POST['username'],
                'type' => $_POST['type'],
                'status' => $_POST['status']
            ]);
            if($result){
                return $this->index();
            }
        }

        $user = $userTable->findOne($_GET['id']);
        
        if ($user === false)
        {
            $this->notFound();
        }

        $form = new BootstrapForm($user);
        
        $token = $this->formToken();

        $this->render('admin.users.edit', compact('form', 'token', 'user'));
    }
    
    public function delete()
    {
        $userTable = App::getInstance()->getTable('User');

        if (!empty($_POST)){
            $result = $userTable->delete($_POST['id']);
            return $this->index();
        }
    }
}
