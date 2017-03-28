<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 *
 */
class ForgotEntity extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $forgotcode;
    
    /**
     * @var string
     */
    protected $user;
    
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
    public function getForgotcode()
    {
        return $this->forgotcode;
    }

    /**
     * @return void
     */
    public function setForgotcode()
    {
        $this->forgotcode = $forgotcode;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
}
