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
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }
        
        $form = new BootstrapForm($_POST);
        
        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp);
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories', 'form'));
    }
    
    public function searchResults()
    {
        
    }
    
    public function indexByCategory()
    {
        
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
