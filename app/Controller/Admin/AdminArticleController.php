<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminArticleController extends AdminAppController
{
    public function index()
    {
        $articles = App::getInstance()->getTable('Article')->getAll();
        $this->render('admin.articles.index', compact('articles'));
    }
    
    public function add()
    {
        $articleTable = App::getInstance()->getTable('Article');

        if (!empty($_POST)){
            $result = $articleTable->create([
                'title' => $_POST['title'],
                'text'  => $_POST['text'],
                'categorie_id' => $_POST['categorie_id']
            ]);
            if($result)
            {
                return $this->index();
            }
        }

        $categories = App::getInstance()->getTable('Categorie')->extract('id', 'name');

        $form = new BootstrapForm($_POST);
        
        $this->render('admin.articles.add', compact('categorie', 'form'));
    }
    
    public function edit()
    {
        $articleTable = App::getInstance()->getTable('Article');

        if (!empty($_POST)){
            $result = $articleTable->update($_GET['id'], [
                'title' => $_POST['title'],
                'text'  => $_POST['text'],
                'categorie_id' => $_POST['categorie_id']
            ]);
            if($result){
                return $this->index();
            }
        }

        $article = $articleTable->findWithCategorie($_GET['id']);
        $categorie = App::getInstance()->getTable('Categorie')->extract('id', 'name');

        $form = new BootstrapForm($article);
        
        $this->render('admin.articles.edit', compact('categorie', 'form'));
    }
    
    public function delete()
    {
        $articleTable = App::getInstance()->getTable('Article');

        if (!empty($_POST)){
            $result = $articleTable->delete($_POST['id']);
            return $this->index();
        }
    }
}