<?php

namespace App\Controller\Admin;

use \App;
use \DateTime;
use Core\Form\BootstrapForm;
use App\Validator\Validator;

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
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {

            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
            
            $error = false;
            
            $articleTable = App::getInstance()->getTable('Article');
            $article = $articleTable->findWithCategorie($_GET['id']);
            $categories = App::getInstance()->getTable('Categorie')->getAll();
            
            if (!empty($_POST)){
                
                $validator = new Validator;
 
                $title      = strip_tags($_POST['title']);
                
                $post_array = array(
                    ['type' => 'title', 'field' => $title],
                    ['type' => 'text', 'field' => $_POST['text']]
                );
                
                $errors_msgs = $validator->validateForm($post_array);
                
                if ($errors_msgs == false) {
                    if ($this->checkToken() == false) {
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/admin/article/edit/' . $_GET['id'] . '');
                    } else {
                        
                        $text       = $_POST['text'];
                        $categorie  = $_POST['categorie'];
                        
                        if (isset($_POST['publish']) && $_POST['publish'] == 1) {
                            $publish = true;
                        } else {
                            $publish = false;
                        }
                        
                        if (isset($_POST['comment']) && $_POST['comment'] == 1) {
                            $comment = true;
                        } else {
                            $comment = false;
                        }
                        
                        $datetime = new DateTime();
                        $date     = $datetime->format('Y-m-d H:i:s');
                        
                        $result = $articleTable->update($_GET['id'], [
                            'title'          => $title,
                            'text'           => $text,
                            'categorie_id'   => $categorie,
                            'published'      => $publish,
                            'commentsActive' => $comment,
                            'datePublished'  => $date
                        ]);
                        if($result){
                            $_SESSION['form_errors'] = array();
                            $_SESSION['flash'] = 'Article modifié avec succès.';
                            header('Location: /writer/web/admin/articles/1');
                        }
                    }
                } else {
                    $error = true;
                }
                
                $article = $articleTable->findWithCategorie($_GET['id']);
                $form = new BootstrapForm($_POST);
            } else {
                $form = new BootstrapForm($article);
            }

            if ($article === false)
            {
                $this->notFound();
            }
  
            $token = $this->formToken();
        
            $this->render('admin.articles.edit', compact('categories', 'form', 'token', 'msg'));
        } else {
            $this->notAuthorized();
        } 
    }
    
    public function delete()
    {
        if ((!isset($_POST['delete'])) || 
            (!isset($_SESSION['token']) && $_SESSION['token'] !== $_POST['token']) ||
            (!isset($_SESSION['type']) || $_SESSION['type'] !== 'Admin')) {
            
            $message = 'Action non autorisée.';
            $this->notAuthorizedAjax();
            echo json_encode($message);
            
        } else {
            $delete_id = $_POST['delete'];
            $articleTable = App::getInstance()->getTable('Article');
            $article = $articleTable->findOne($delete_id);

            if ($article == false) {
                $message = 'Il y a eu un probleme lors de votre requete.';
                $this->notFoundAjax();
                echo json_encode($message);
            } else {
                $result = $articleTable->delete($delete_id);
                if($result){
                    $message = 'Article supprime avec succes.';
                    echo json_encode($message);
                } else {
                    $message = 'Il y a eu un probleme lors de votre requete.';
                    $this->badRequestAjax();
                    echo json_encode($message);
                }
            }
        }
    }
}
