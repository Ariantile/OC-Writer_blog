<?php

namespace Core\Form;

/**
 * Class BootstrapForm
 * Génération de formulaire avec des classes bootstrap
 */
class BootstrapForm extends Form
{
    /**
     * @param $html string Code HTML
     * @return string
     */
    private function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }
    
    /**
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
            '<input id="input-' . $name . '" type="' . $type . '" placeholder ="' . $placeholder . '" name="' . $name . '"  value="'. $value . '" class="form-control">'
        );
    }
    
    /**
     * @param $name string
     * @return string
     */
    public function checkbox($name)
    {
        $value = $this->getValue($name);
        
        return $this->surround(
            '<input id="input-' . $name . '" type="checkbox" name="' . $name . '"  value="'. $value . '">'
        );
    }
    
    /**
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
    
    public function select($name, $label, $options)
    {
        $label = '<label>' . $label . '</label>';
        $input = '<select class ="form-control" name="' . $name . '">';
        foreach($options as $k => $v)
        {
            $attributes = '';
            if($k == $this->getValue($name)){
                $attributes = ' selected';
            }
            
            $input .= "<option value='" . $k . " - " . $attributes . "'>" . $v->getName() . "</option>";
        }
        $input .= '</select>';
        return $this->surround($label . $input);
    }
    
    /**
     * @return string
     */
    public function submit($label = null)
    {
        $label = isset($label) ? $label : 'Envoyer';
        
        return $this->surround(
            '<button type="submit" class="btn btn-primary">' . $label . '</button>'
        );
    }
}