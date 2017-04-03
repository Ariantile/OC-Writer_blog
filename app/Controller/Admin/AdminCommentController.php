<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;
use App\Validator\Validator;

class AdminCommentController extends AdminAppController
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
        
            $comments = App::getInstance()->getTable('Comment')->paginateComments($cp, $type);
            $this->render('admin.comments.index', compact('comments', 'token', 'form', 'msg'));
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
            
            $commentTable = App::getInstance()->getTable('Comment');
            $comment = $commentTable->findCommentById($_GET['id']);
            
            if (!empty($_POST)) {
                
                $validator = new Validator;
 
                $comment = strip_tags($_POST['comment']);
                
                $post_array = array(
                    ['type' => 'comment', 'field' => $comment]
                );
                
                $errors_msgs = $validator->validateForm($post_array);
                
                if ($errors_msgs == false) {
                    if ($this->checkToken() == false) {
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/admin/comment/edit/' . $_GET['id'] . '');
                    } else {
                        
                        if (isset($_POST['flag']) && $_POST['flag'] == 1) {
                            $flag = true;
                        } else {
                            $flag = false;
                        }
                        
                        $result = $commentTable->update($_GET['id'], [
                            'comment' => $comment,
                            'flag'    => $flag
                        ]);
                        if($result){
                            $_SESSION['form_errors'] = array();
                            $_SESSION['flash'] = 'Commentaire modifié avec succès.';
                            header('Location: /writer/web/admin/commentaires/1');
                        }
                    } 
                } else {
                    $error = true;
                }
                
                $comment = $commentTable->findCommentById($_GET['id']);
                $form = new BootstrapForm($_POST);
                
            } else {
                $form = new BootstrapForm($comment);
            }

            if ($comment === false)
            {
                $this->notFound();
            }
            
            $token = $this->formToken();

            $this->render('admin.comments.edit', compact('comment', 'form', 'token'));

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
            $commentTable = App::getInstance()->getTable('Comment');
            $comment = $commentTable->findOne($delete_id);
            
            if ($comment == false) {
                $message = 'Il y a eu un probleme lors de votre requete.';
                $this->notFoundAjax();
                echo json_encode($message);
            } else {

                if ($comment->level == 2) {
                    $children = $commentTable->findChildToDelete($delete_id);

                    if ($children !== false) {
                        foreach ($children as $child){
                            $commentTable->delete($child->id);
                        }
                        
                        $result = $commentTable->delete($delete_id);
                    }
                } else if ($comment->level == 1) {
                    
                    $children = $commentTable->findChildToDelete($delete_id);
                    
                    if ($children !== false) {
                        foreach ($children as $child) {
                            $lastChildren = $commentTable->findChildToDelete($child->id);
                            
                            if ($lastChildren !== false) {
                                foreach ($lastChildren as $lastChild) {
                                    $commentTable->delete($lastChild->id);
                                }
                            }
                            
                            $commentTable->delete($child->id);
                        }
                    }
                    $result = $commentTable->delete($delete_id);
                }

                if($result){
                    $message = 'Commentaire(s) supprime(s) avec succes.';
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
  