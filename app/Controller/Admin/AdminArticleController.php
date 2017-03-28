<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminArticleController extends AdminAppController
{
    public function index()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }

        $form = new BootstrapForm($_POST);
        
        $type = 'admin';
        
        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp, $type);
        $this->render('admin.articles.index', compact('articles', 'form'));
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
        
        if ($article === false)
        {
            $this->notFound();
        }
        
        $categories = App::getInstance()->getTable('Categorie')->getAll();

        $form = new BootstrapForm($article);
        
        $token = $this->formToken();
        
        $this->render('admin.articles.edit', compact('categories', 'form', 'token'));
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
