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
        
        $form = new BootstrapForm($_POST);
        
        $this->render('admin.categories.add', compact('categories', 'form'));
    }
    
    public function edit()
    {
        $categorieTable = App::getInstance()->getTable('Article');

        if (!empty($_POST)){
            $result = $categorieTable->update($_GET['id'], [
                'title' => $_POST['title'],
                'text'  => $_POST['text'],
                'categorie_id' => $_POST['categorie_id']
            ]);
            if($result){
                return $this->index();
            }
        }

        $categorie = $categorieTable->find($_GET['id']);

        $form = new BootstrapForm($categorie);
        
        $this->render('admin.categories.edit', compact('form'));
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
