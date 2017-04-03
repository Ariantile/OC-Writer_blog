<?php

namespace App\Controller;

use \App;
use Core\Auth;
use \DateTime;
use Core\Form\BootstrapForm;
use App\Validator\Validator;
use Core\PaginateComments\PaginateComments;

class ArticleController extends AppController
{
    public function home()
    {
        $articles = App::getInstance()->getTable('Article')->getLast();
        
        $this->render('home', compact('articles'));
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
        
        if (isset($_GET['key'])) {
            $type = 'search';
            $key = $_GET['key'];
        
            $articles = App::getInstance()->getTable('Article')->paginateArticles($cp , $type, null , $_GET['key']);
            $categories = App::getInstance()->getTable('Categorie')->getAll();
        } else {
            $type = 'all';
            $articles = App::getInstance()->getTable('Article')->paginateArticles($cp , $type);
        }
        
        $categories = App::getInstance()->getTable('Categorie')->getAll();
        
        $this->render('articles.index', compact('articles', 'categories', 'form', 'type', 'key'));
    }
    
    public function read()
    {
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
        
        $error = false;

        if(!empty($_POST))
        {
            $validator = new Validator;

            $content    = strip_tags($_POST['comment']);
            $parent_id  = $_POST['respond_to'];
            
            $post_array = array(
                ['type' => 'comment', 'field' => $content]
            );

            $errors_msgs = $validator->validateForm($post_array);

            if ($errors_msgs == false) {

                if ($this->checkToken() == false){
                    $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                    header('Location: /writer/web/article/' . $_GET['id'] . '/1');
                } else {
                    
                    $commentTable = App::getInstance()->getTable('Comment');
                    
                    if ($parent_id > 0) {
                        $check_parent = $commentTable->checkCommentParent($parent_id);
                        
                        if ($check_parent->level >= 3 || $check_parent->article !== $_GET['id'] ) {
                            $this->badRequest();
                        }
                    
                        $level = $check_parent->level + 1;
                        $parentId = $check_parent->id;
                    } else {
                        $level = 1;
                        $parentId = 0;
                    }
                    
                    $datetime = new DateTime();
                    $date     = $datetime->format('Y-m-d H:i:s');
                    
                    $result = $commentTable->create([
                            'comment'        => $content,
                            'flag'           => false,
                            'datePosted'     => $date,
                            'level'          => $level,
                            'parent_id'      => $parentId,
                            'article_id'     => $_GET['id'],
                            'user_id'        => $_SESSION['auth']
                        ]);
                    if($result) {
                        $_SESSION['flash'] = 'Commentaire publié avec succès.';
                        header('Location: /writer/web/article/' . $_GET['id'] . '/1');
                    } 
                }
            } else {
                $error = true;
            }
        }
        
        $app = App::getInstance();
        $article = $app->getTable('Article')->findWithCategorie($_GET['id']);
        
        if ($article === false) {
            $this->notFound();
        } else if (($article->published === false) && (!isset($_SESSION['type']))) {
            $this->notAuthorized();
        } else if (($article->published === false) && (isset($_SESSION['type']) && $_SESSION['type'] !== 'Admin')) {
            $this->notAuthorized();
        } else {
            
            $type = 'read';
            
            $commentTable = App::getInstance()->getTable('Comment');
            $comments = $commentTable->paginateComments($cp, $type, $article->id);
            
            $token = $this->formToken();
            $cur = $this->currentPage();
            
            $form = new BootstrapForm($_POST);

            $this->render('articles.read', compact('article', 'comments', 'form', 'error', 'form_errors', 'token', 'cur', 'msg'));
        }
    }
    
    public function ajaxComments()
    {
        if ((!isset($_POST['parent'])) || 
            (!isset($_SESSION['reading']) && $_SESSION['reading'] !== $_POST['cur']) ||
            (!isset($_SESSION['token']) && $_SESSION['token'] !== $_POST['token'])) {
            
            $this->badRequest();
            
        } else {
            $parent_id = $_POST['parent'];
            $comments = App::getInstance()->getTable('Comment')->getCommentsWithParent($parent_id, $_POST['cur']);
            
            if ($comments == false) {
                $this->badRequest();
            } else {
                $pag_comments = new PaginateComments;
                $data = $pag_comments->showCommentAjax($comments);
                echo json_encode($data);
            }
        }
    }
    
    public function ajaxSignalComments()
    {
        if ((!isset($_POST['signal'])) || 
            (!isset($_SESSION['reading']) && $_SESSION['reading'] !== $_POST['cur']) ||
            (!isset($_SESSION['token']) && $_SESSION['token'] !== $_POST['token']) ||
            (!isset($_SESSION['type']))) {

            $this->notAuthorizedAjax();
            
        } else {
            $commentSignal = $_POST['signal'];
            $commentTables = App::getInstance()->getTable('Comment');
            $comment = $commentTables->getCommentFlag($commentSignal, $_POST['cur']);
            
            if ($comment == false) {
                $this->notFoundAjax();
            } else {
                
                if ($comment->flag == true) {
                    $this->badRequestAjax();
                    $message = 'Ce commentaire a déjà été signalé.';
                    echo json_encode($message);
                } else {
                    
                    $result = $commentTables->update($commentSignal, [
                        'flag' => true
                    ]);
                    if($result){
                        $message = 'Merci de votre signalement.';
                        echo json_encode($message);
                    } else {
                        $this->badRequestAjax();
                        $message = '<div class="alert alert-info flag-message">Il y a eu un problème lors de votre requête, veuillez nous excuser pour la gène occasionnée.</div>';
                        echo json_encode($message);
                    }
                }
            }
        }
    }
    
    public function write()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {

            if (isset($_SESSION['flash']))
            {
                $msg = $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
        
            $error = false;
        
            if(!empty($_POST))
            {
                $validator = new Validator;
 
                $title      = strip_tags($_POST['title']);
                
                $post_array = array(
                    ['type' => 'title', 'field' => $title],
                    ['type' => 'text', 'field' => $_POST['text']],
                    ['type' => 'categorie_id', 'field' => $_POST['categorie_id']],
                );

                $errors_msgs = $validator->validateForm($post_array);

                if ($errors_msgs == false) {

                    if ($this->checkToken() == false){
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/article/ajouter');
                    } else {
                        
                        $articleTable = App::getInstance()->getTable('Article');

                        $text       = $_POST['text'];
                        $categorie  = $_POST['categorie_id'];
                        
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
                        
                        $result = $articleTable->create([
                            'title'          => $title,
                            'text'           => $text,
                            'categorie_id'   => $categorie,
                            'published'      => $publish,
                            'commentsActive' => $comment,
                            'datePublished'  => $date,
                            'user_id'        => $_SESSION['auth']
                        ]);
                        if($result) {
                            
                            $article_id = App::getInstance()->getTable('Article')->lastInsert();
                            
                            if ($publish == true) {
                                $_SESSION['flash'] = 'Article publié avec succès.';
                                header('Location: /writer/web/article/' . $article_id . '');
                            } else {
                                $_SESSION['flash'] = 'Article sauvegardé avec succès. Celui-ci n\'est pas encore publié.';
                                header('Location: /writer/web/admin/article/edit/' . $article_id . '');
                            }
                        }
                    }
                } else {
                    $error = true;
                }
            }
            
            $form = new BootstrapForm($_POST);
        
            $categories = App::getInstance()->getTable('Categorie')->getAll();
            
            $token = $this->formToken();
            
            $this->render('articles.write', compact('form', 'error', 'form_errors', 'token', 'msg', 'categories'));
            
        } else {
            $this->notAuthorized();
        }
    }
}
