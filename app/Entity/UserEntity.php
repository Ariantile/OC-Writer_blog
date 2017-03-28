<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 *
 */
class UserEntity extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;
    
    /**
     * @var string
     */
    protected $email;
    
    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;
    
    /**
     * @var string
     */
    protected $activation;
    
    /**
     * @var boolean
     */
    protected $activated;
    
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return void
     */
    public function setUsername()
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return void
     */
    public function setEmail()
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return void
     */
    public function setPassword()
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return void
     */
    public function setType()
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return void
     */
    public function setStatus()
    {
        $this->status = $status;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getActivation()
    {
        return $this->activation;
    }

    /**
     * @return void
     */
    public function setActivation()
    {
        $this->activation = $activation;
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * @return void
     */
    public function setActivated()
    {
        $this->activated = $activated;
        return $this;
    }
    
    public function getUrl()
    {
        return '/writer/web/membre/' . $this->id;
    }
}
