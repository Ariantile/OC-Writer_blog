<?php

namespace App\Controller\Admin;

use \App;
use Core\Form\BootstrapForm;
use App\Validator\Validator;

class AdminCategorieController extends AdminAppController
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
        
            $error = false;  
             
            if(!empty($_POST))
            {
                $validator = new Validator;
 
                $cat = strip_tags($_POST['categorie']);
                
                $post_array = array(
                    ['type' => 'categorie', 'field' => $cat],
                );
                
                $errors_msgs = $validator->validateForm($post_array);
                
                if ($errors_msgs == false) {

                    if ($this->checkToken() == false){
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/admin/categories/1');
                    } else {
                        
                        $categorieTable = App::getInstance()->getTable('Categorie');
                        
                        $result = $categorieTable->create([
                            'name' => $cat
                        ]);
                        if($result) {
                            $_SESSION['flash'] = 'Nouvelle catégorie ajoutée avec succès.';
                            header('Location: /writer/web/admin/categories/1');
                        }
                    }
                } else {
                    $error = true;
                }
            }
            
            $form = new BootstrapForm($_POST);
            $token = $this->formToken();

            $categories = App::getInstance()->getTable('Categorie')->paginateCategories($cp);
            $this->render('admin.categories.index', compact('categories', 'form', 'token', 'error', 'form_errors', 'msg'));
            
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
            
            $categorieTable = App::getInstance()->getTable('Categorie');
            $categorie = $categorieTable->findOne($_GET['id']);

            if (!empty($_POST)) {
                $validator = new Validator;
 
                $cat = strip_tags($_POST['name']);
                
                $post_array = array(
                    ['type' => 'name', 'field' => $cat]
                );
                
                $errors_msgs = $validator->validateForm($post_array);
                
                if ($errors_msgs == false) {

                    if ($this->checkToken() == false) {
                        $_SESSION['flash'] = 'Session expirée, veuillez recommencer.';
                        header('Location: /writer/web/admin/categorie/edit/' . $_GET['id'] . '');
                    } else {
                        
                        $result = $categorieTable->update($_GET['id'], [
                            'name' => $cat
                        ]);
                        if($result){
                            $_SESSION['form_errors'] = array();
                            $_SESSION['flash'] = 'Catégorie modifiée avec succès.';
                            header('Location: /writer/web/admin/categories/1');
                        }
                    } 
                } else {
                    $error = true;
                }
                $form = new BootstrapForm($_POST);
            } else {
                $form = new BootstrapForm($categorie);
            }

            if ($categorie === false)
            {
                $this->notFound();
            }

            $token = $this->formToken();

            $this->render('admin.categories.edit', compact('form', 'token'));
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
            $categorieTable = App::getInstance()->getTable('Categorie');
            $categorie = $categorieTable->findOne($delete_id);
            
            $articleTable = App::getInstance()->getTable('Article');
            $articles = $articleTable->countArticlesByCategorie($delete_id);
            
            if ($categorie == false) {
                $message = 'Il y a eu un probleme lors de votre requete.';
                $this->notFoundAjax();
                echo json_encode($message);
            } else if ($articles[0]->allArticles > 0) {
                $message = 'Impossible de supprimer une categorie contenant deja des articles.';
                $this->badRequestAjax();
                echo json_encode($message);
            } else {
                $result = $categorieTable->delete($delete_id);
                if($result){
                    $message = 'Catégorie supprimée avec succès.';
                    echo json_encode($message);
                } else {
                    $message = 'Il y a eu un problème lors de votre requête.';
                    $this->badRequestAjax();
                    echo json_encode($message);
                }
            }
        }
    }
}
