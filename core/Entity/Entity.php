<?php

namespace Core\Entity;

/**
 * Class Entity
 * Class mère des entités
 */
class Entity {
    
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->key = $this->$method();
        return $this->$key;
    } 
}
