<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;

class AdminCommentController extends AdminAppController
{
    public function index()
    {
        if (isset($_GET['cp'])){
            $cp = $_GET['cp'];
        } else {
            $cp = 1;
        }

        $comments = App::getInstance()->getTable('Comment')->paginateComments($cp);
        $this->render('admin.comments.index', compact('comments'));
    }

    public function edit()
    {
        $commentTable = App::getInstance()->getTable('Comment');

        if (!empty($_POST)){
            $result = $commentTable->update($_GET['id'], [
                'comment'   => $_POST['comment'],
                'flag'      => $_POST['flag']
            ]);
            if($result){
                return $this->index();
            }
        }

        $comment = $commentTable->findCommentById($_GET['id']);
        
        if ($comment === false)
        {
            $this->notFound();
        }
        
        $form = new BootstrapForm($comment);
        
        $token = $this->formToken();

        $this->render('admin.comments.edit', compact('comment', 'form', 'token'));
    }
    
    public function delete()
    {
        $commentTable = App::getInstance()->getTable('Comment');

        if (!empty($_POST)){
            $result = $commentTable->delete($_POST['id']);
            return $this->index();
        }
    }
}
  