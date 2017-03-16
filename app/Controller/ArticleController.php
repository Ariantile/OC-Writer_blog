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
        
        $type = 'all';
        
        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp, $type);
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories', 'form'));
    }
    
    public function indexbycategory()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }
        
        $form = new BootstrapForm($_POST);
        
        $type = 'cat';
        $catId = $_GET['id'];
        
        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp , $type, $_GET['id']);
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories', 'form', 'type', 'catId'));
    }
    
    public function searchresults()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }
        
        $form = new BootstrapForm($_POST);
        
        $type = 'search';
        $key = $_GET['key'];
        
        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp , $type, null , $_GET['key']);
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories', 'form', 'type', 'key'));
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
