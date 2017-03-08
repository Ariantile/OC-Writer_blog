<?php

namespace App\Controller;

use \App;
use Core\Form\BootstrapForm;

class ArticleController extends AppController
{
    public function home()
    {
        $articles = App::getInstance()->getTable('Article')->getLast();
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('home', compact('articles', 'categories'));
    }
    
    public function index()
    {
        $articles = App::getInstance()->getTable('Article')->getLast();
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories'));
    }
    
    public function read()
    {
        $app = App::getInstance();
        $article = $app->getTable('Article')->findWithCategorie($_GET['id']);

        if ($article === false)
        {
            $app->notFound();
        }
        
        $this->render('articles.read', compact('article'));
    }
    
    public function write()
    {
        $form = new BootstrapForm($_POST);
        
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.write', compact('form', 'categories'));
    }
}
