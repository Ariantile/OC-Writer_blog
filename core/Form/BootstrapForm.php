<?php

namespace Core\Form;

/**
 * Class BootstrapForm
 * Génération de formulaire avec des classes bootstrap
 */
class BootstrapForm extends Form
{
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
        $value = $this->getValue($name);
        
        return $this->surround(
            '<input id="input-' . $name . '" type="' . $type . '" placeholder ="' . $placeholder . '" name="' . $name . '"  value="'. $value . '" class="form-control input-text-style">'
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
        $value = $this->getValue($name);
        
        return $this->surround(
            '<label for="input-' . $name . '"><input id="input-' . $name . '" type="checkbox" name="' . $name . '"  value="'. $value . '" class="checkbox-custom" "><span class="checkbox-replace-' . $name . '">' . $label . '</span></label>'
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
        
        return $this->surround(
            '<textarea id="write-area" rows="' . $rows . '" $cols ="' . $cols . '" name="' . $name . '" class="form-control">' . $value . '</textarea>'
        );
    }
    
    /**
     * Génère et retourne une un select
     *
     * @param $name string
     * @param array $options
     * @return string
     */
    public function select($name, $options, $placeholder)
    {
        $input =  '<select class ="form-control input-text-style" name="' . $name . '">';
        $input .= "<option selected value>" . $placeholder . "</option>";
        foreach($options as $k => $v)
        {
            $attributes = '';
            if($k == $this->getValue($name)){
                $attributes = ' selected';
            }
            
            $input .= "<option value='" . $k . " - " . $attributes . "'>" . $v->getName() . "</option>";
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