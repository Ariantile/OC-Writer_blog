<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Entité des catégories
 */
class CategorieEntity extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getUrl()
    {
        return '/writer/web/article/index/cat/' . $this->id . '/1';
    }
}
