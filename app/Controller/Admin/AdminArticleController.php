<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminArticleController extends AdminAppController
{
    public function index()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {
            
            if (isset($_GET['cp'])){
                $cp = $_GET['cp'];
            } else {
                $cp = 1;
            }
            
            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }

            $type = 'admin';
            
            $form = new BootstrapForm();
            $token = $this->formToken();
        
            $articles = App::getInstance()->getTable('Article')->paginateArticles($cp, $type);
            $this->render('admin.articles.index', compact('articles', 'form', 'token', 'msg'));
        } else {
            $this->notAuthorized();
        }
    }
    
    public function edit()
    {
        if (isset($_SESSION['flash']))
        {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        
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
        
        $this->render('admin.articles.edit', compact('categories', 'form', 'token', 'msg'));
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
