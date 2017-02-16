<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminCategorieController extends AdminAppController
{
    public function index()
    {
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        $this->render('admin.categories.index', compact('categories'));
    }
    
    public function add()
    {
        $categorieTable = App::getInstance()->getTable('Categorie');

        if (!empty($_POST)){
            $result = $categorieTable->create([
                'name' => $_POST['title']
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

        $categorie = $articleTable->findWithCategorie($_GET['id']);

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
