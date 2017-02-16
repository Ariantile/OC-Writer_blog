<?php

namespace App\Controller;

use \App;

class ArticleController extends AppController
{
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
    
    public function writeArticle()
    {
        $this->render('articles.write');
    }
}
