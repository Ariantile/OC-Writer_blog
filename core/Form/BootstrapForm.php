<?php

namespace Core\Form;

/**
 * Class BootstrapForm
 * Génération de formulaire avec des classes bootstrap
 */
class BootstrapForm extends Form
{
    /**
     * Affiche les erreurs des formulaires
     *
     * @param $error array
     */
    public function displayErrors($errors_array)
    {
        if (count($errors_array) == 1) {
            $error = '<div class="form-error">' . $errors_array[0] . '</div>';
        } else {
            $error = '';
            foreach ($errors_array as $er) {
                $error .=  '<div class="form-error">' . $er . '</div>';
            }
        }
        return $error;
    }
    
    /**
     * Balise html entourant les input
     *
     * @param $html string Code HTML
     * @return string
     */
    private function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }
    
    /**
     * Génère et retourne l'input de token
     *
     * @param $token string
     * @return string
     */
    public function token($token)
    {
        return '<input id="token" type="hidden" name="token" value="'. $token . '">';
    }
    
    /**
     * Génère et retourne l'input de page courrante
     *
     * @param $token string
     * @return string
     */
    public function cur($cur)
    {
        return '<input id="cur" type="hidden" name="cur" value="'. $cur . '">';
    }
    
    /**
     * Génère et retourne l'input de page courrante
     *
     * @param $token string
     * @return string
     */
    public function responseid()
    {
        return '<input id="respond_to_id" type="hidden" name="respond_to" value="0">';
    }
    
    /**
     * Génère et retourne un input
     *
     * @param $name string
     * @param $placeholder
     * @param array $options
     * @return string
     */
    public function input($name, $placeholder = null, $label = null, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        
        if (isset($options['required']) && $options['required'] == true) {
            $req = 'required';
        } else {
            $req = '';
        }
         
        $value = $this->getValue($name);
        
        if (isset($_SESSION['form_errors'][$name])) {
            $error = $this->displayErrors($_SESSION['form_errors'][$name]);
            unset($_SESSION['form_errors'][$name]);
        } else {
            $error = '';
        }
        
        return $this->surround(
            '<input id="input-' . $name . '" type="' . $type . '" placeholder ="' . $placeholder . '" name="' . $name . '"  value="'. $value . '" class="form-control input-text-style" ' . $req . '>' . $error . ''
        );
    }
    
    /**
     * Génère et retourne un input de type checkbox
     *
     * @param $name string
     * @return string
     */
    public function checkbox($name, $label)
    {
        $value = 1;
        
        return $this->surround(
            '<label for="input-' . $name . '"><input id="input-' . $name . '" type="checkbox" name="' . $name . '"  value="'. $value . '" class="checkbox-custom" "><span class="checkbox-replace-' . $name . '">' . $label . '</span></label>'
        );
    }
    
    /**
     * Génère et retourne un input de type checkbox pour l'administration
     *
     * @param $name string
     * @return string
     */
    public function checkboxAdmin($name, $label)
    {
        $value = $this->getValue($name);
        $attributes = '';
        
        if ($value == true) {
            $attributes = 'checked';
        }
        
        return $this->surround(
            '<input ' . $attributes . ' id="input-' . $name . '" type="checkbox" name="' . $name . '"  value="'. $value . '">'
        );
    }
    
    /**
     * Génère et retourne une textarea
     *
     * @param $name string
     * @param array $options
     * @return string
     */
    public function textarea($name, $options = [])
    {
        $rows = isset($options['rows']) ? $options['rows'] : '6';
        
        $cols = isset($options['cols']) ? $options['cols'] : '50';
        $value = $this->getValue($name);
        
        if (isset($options['required']) && $options['required'] == true) {
            $req = 'required';
        } else {
            $req = '';
        }
        
        if (isset($options['max'])) {
            $max = 'maxlength ="' . $options['max'] . '"';
        } else {
            $max = '';
        }
        
        if (isset($_SESSION['form_errors'][$name])) {
            $error = $this->displayErrors($_SESSION['form_errors'][$name]);
            unset($_SESSION['form_errors'][$name]);
        } else {
            $error = '';
        }
        
        return $this->surround(
            '<textarea '. $max .' id="write-area" rows="' . $rows . '" $cols ="' . $cols . '" name="' . $name . '" class="form-control"' . $req . '>' . $value . '</textarea>' . $error . ''
        );
    }
    
    /**
     * Génère et retourne un select
     *
     * @param $name string
     * @param array $options
     * @return string
     */
    public function select($name, $options, $placeholder = null, $config = [])
    {
        if (isset($config['required']) && $config['required'] == true) {
            $req = 'required';
        } else {
            $req = '';
        }
        
        if (isset($_SESSION['form_errors'][$name])) {
            $error = $this->displayErrors($_SESSION['form_errors'][$name]);
            unset($_SESSION['form_errors'][$name]);
        } else {
            $error = '';
        }
        
        $input =  '<select class ="form-control input-text-style" name="' . $name . '"' . $req . '>';
        
        if (isset($placeholder))
        {
            $input .= "<option selected value>" . $placeholder . "</option>";
        }
        
        foreach($options as $k => $v)
        {
            $attributes = '';
            
            if($v->name == $this->getValue($name)){
                $attributes = ' selected';
            }
            
            if (isset($config['type']) && $config['type'] == 'cat_write')
            {
                $val = $v->id;
            }
            
            $input .= '<option value="' . $val . '" ' . $attributes . '>' . $v->getName() . '</option>';
        }
        $input .= '</select>' . $error . '';
        return $this->surround($input);
    }
    
    /**
     * Génère et retourne un select
     *
     * @param $name string
     * @param array $options
     * @return string
     */
    public function selectUserAdmin($name, $options)
    {
        $input =  '<select class ="form-control input-text-style" name="' . $name . '">';
        $value = $this->getValue($name);
        
        if ($name == 'type') {
            
            $types = array(
                ['name' => 'Admin', 'placeholder' => 'Admin'],
                ['name' => 'Member', 'placeholder' => 'Membre']
            );
            
            foreach ($types as $t) {
                $attributes = '';
                
                if ($value == $t['name']) {
                    $attributes = 'selected';
                }
                
                $input .= '<option value="' . $t['name'] . '" ' . $attributes . '>' . $t['placeholder'] . '</option>';
            }

        } else if ($name == 'status') {
            
            $allStatus = array(
                ['name' => 'Registred', 'placeholder' => 'Enregistré'],
                ['name' => 'Validated', 'placeholder' => 'Validé'],
                ['name' => 'Ban', 'placeholder' => 'Banni'],
            );
            
            foreach ($allStatus as $s) {
            
                $attributes = '';

                if ($value == $s['name']) {
                    $attributes = 'selected';
                }
                
                $input .= '<option value="' . $s['name'] . '" ' . $attributes . '>' . $s['placeholder'] . '</option>';
            }
        }
        
        $input .= '</select>';
        return $this->surround($input);
    }
    
    /**
     * Génère et retourne un bouton submit
     *
     * @param $label string
     * @return string
     */
    public function submit($label = null, $classType = null)
    {
        $label = isset($label) ? $label : 'Envoyer';
        
        if (isset($classType) && $classType == 'add') {
            $class = 'bt-custom-action bt-custom-action-add';
        } else {
            $class = 'btn btn-custom';
        }
        
        return $this->surround(
            '<button type="submit" class="' . $class . '">' . $label . '</button>'
        );
    }
}
