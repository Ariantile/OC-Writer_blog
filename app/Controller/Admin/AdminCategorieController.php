<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminCategorieController extends AdminAppController
{
    public function index()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }

        $form = new BootstrapForm($_POST);

        $categories = App::getInstance()->getTable('Categorie')->paginateCategories($cp);
        $this->render('admin.categories.index', compact('categories', 'form'));
    }
    
    public function edit()
    {
        $categorieTable = App::getInstance()->getTable('Categorie');

        if (!empty($_POST)){
            $result = $categorieTable->update($_GET['id'], [
                'name' => $_POST['name']
            ]);
            if($result){
                return $this->index();
            }
        }

        $categorie = $categorieTable->findOne($_GET['id']);

        if ($categorie === false)
        {
            $this->notFound();
        }
        
        $form = new BootstrapForm($categorie);
        
        $token = $this->formToken();

        $this->render('admin.categories.edit', compact('form', 'token'));
    }
    
    public function add()
    {
        $categorieTable = App::getInstance()->getTable('Categorie');

        if (!empty($_POST)){
            $result = $categorieTable->create([
                'name' => $_POST['name']
            ]);
            if($result)
            {
                return $this->index();
            }
        }
    }
    
    public function delete()
    {
        $categorieTable = App::getInstance()->getTable('Categorie');

        if (!empty($_POST)){
            $result = $categorieTable->delete($_POST['id']);
            return $this->index();
        }
    }
}
