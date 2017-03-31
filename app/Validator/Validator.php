<?php

namespace app\Validator;

use \App;

/**
 * Class Validators
 * Classe qui gère les erreurs de formulaires
 */
class Validator
{
    /**
     * Traite toutes les données postées
     *
     * @param array $post_array
     *
     * @return array
     */
    public function validateForm($post_array) 
    {
        $errors_msgs = [];
            
        foreach ($post_array as $field) {
            if ($field['type'] == 'email' || $field['type'] == 'password') {
                $check = $this->validate($field['field'], $field['type'], $field['field_conf']);
            } else {
                $check = $this->validate($field['field'], $field['type']);
            }
                
            if (!empty($check)) {
                $errors_msgs[$field['type']] = $check;
                $_SESSION['form_errors'] = $errors_msgs;
            }
        }
        
        if (empty($errors_msgs)) {
            return false;
        } else {
            return $errors_msgs;
        }
    }
    
    /**
     * Vérifie les données des champs postés
     *
     * @param array $errors
     *
     * @return array
     */
    public function validate($field, $type, $field_conf = null)
    {
        $msg_empty              = 'Ce champs ne peut être vide.';
        $msg_empty_conf         = 'Ce champs ne peut être vide.';
        $msg_min                = 'Ce champs doit contenir au moins deux caractères.';
        $msg_max_comment        = 'Votre commentaire ne doit contenir plus de 500 caractères.';
        $msg_username_unique    = 'Nom d\'utilisateur déjà utilisée.';
        $msg_mail               = 'Adresse courriel incorrecte, format adresse@mail.com';
        $msg_mail_unique        = 'Adresse courriel déjà utilisée.';
        $msg_mail_conf          = 'Les deux champs d\'adresse courriel doivent correspondre.';
        $msg_pass               = 'Votre mot de passe doit contenir au moins 8 caractères, dont 1 chiffre et une lettre.';
        $msg_pass_conf          = 'Les champs de mot de passe doivent correspondre.';
        $msg_mail_exist         = 'Adresse courriel non trouvée. Veuillez vérifier les inforations saissies';
        $msg_mail_exist_status  = 'Compte banni ou inactif.';
        
        $errors = [];
        $length = strlen($field);
        
        if (empty($field)) {
            array_push($errors, $msg_empty);
        } else if ( ($length < 2) && ($type !== 'categorie_id') ) {
            array_push($errors, $msg_min);
        }
        
        if ( ($type == 'comment') && ($length > 500) ) {
            array_push($errors, $msg_max_comment);
        }
        
        if ($type == 'username') {
            $check_unique_username = App::getInstance()->getTable('User')->findOneUnique('username', $field);
            
            if (!empty($check_unique_username)){
                array_push($errors, $msg_username_unique);
            }
        }
        
        if ($type == 'email') {
            $check_unique_email = App::getInstance()->getTable('User')->findOneUnique('email', $field);
            
            if (filter_var($field, FILTER_VALIDATE_EMAIL) == false) {
                array_push($errors, $msg_mail);
            }
            
            if (!empty($check_unique_email)){
                array_push($errors, $msg_mail_unique);
            }
            
            if ((isset($field_conf)) && ($field !== $field_conf)) {
                array_push($errors, $msg_mail_conf);
            }
        }
        
        if ($type == 'emailexist') {
            $check_exist_email = App::getInstance()->getTable('User')->findOneUnique('email', $field);
            
            if (empty($check_exist_email)){
                array_push($errors, $msg_mail_exist);
            }
        }
        
        if ($type == 'password') {
            if ($length < 8 || !preg_match("#[0-9]+#", $field) || !preg_match("#[a-z]+#", $field)) {
                array_push($errors, $msg_pass);
            }
            
            if ((isset($field_conf)) && ($field != $field_conf)){
                array_push($errors, $msg_pass_conf);
            }
        }
        
        if ($type == 'sendforgot') {
            
            $check_exist_email = App::getInstance()->getTable('User')->findOneByEmail($field);
            
            if (empty($check_exist_email)){
                array_push($errors, $msg_mail_exist);
            } else if ($check_exist_email->status == 'Ban' ||
                $check_exist_email->status == 'Registred' ||
                $check_exist_email->activated == false){
                array_push($errors, $msg_mail_exist_status);
            }
        }
        
        return $errors;
    }
}