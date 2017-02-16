<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 *
 */
class CategorieEntity
{
    /**
     *
     */
    public function __construct()
    {
    }

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
        return 'index.php?p=categorie&id=' . $this->id;
    }

}
