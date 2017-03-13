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

        $articles = App::getInstance()->getTable('Article')->paginateArticles($cp);
        $this->render('admin.articles.index', compact('articles'));
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
