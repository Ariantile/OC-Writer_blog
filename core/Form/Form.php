<?php

namespace Core\Form;

/**
 * Class Form
 * Génération de formulaire
 */
class Form
{
    /**
     * Données du formulaire
     *
     * @var array Data du formulaire
     */
    private $data;
    
    /**
     * Balise html entourant les input
     *
     * @var string Tag entourant les champs
     */
    public $surround = 'p';
    
    /**
     * @param array $data Data du formulaire
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }
    
    /**
     * Génère et retourne les balise html entourant les input
     *
     * @param $html string Code HTML
     * @return string
     */
    private function surround($html)
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }
    
    protected function getValue($index)
    {
        if(is_object($this->data)){
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }
    
    /**
     * Génère et retourne un input
     *
     * @param $name string
     * @param $placeholder
     * @param array $options
     * @return string
     */
    public function input($name, $placeholder, $options = [])
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $value = $this->getValue($name);
        
        return $this->surround(
            '<input type="' . $type . '" placeholder ="' . $placeholder . '" name="' . $name . '" value="'. $value . '">'
        );
    }
    
    /**
     * Génère et retourne un bouton submit
     *
     * @param $label string
     * @return string
     */
    public function submit()
    {
        return $this->surround(
            '<button type="submit">Envoyer</button>'
        );
    }
}
