<?php

namespace App\Entity;

/**
 *
 */
class UserEntity
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
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @return int
     */
    public function getId()
    {
        // TODO: implement here
        return 0;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setUsername()
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setPassword()
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setSalt()
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return string
     */
    public function getType()
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setType()
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setStatus()
    {
        // TODO: implement here
        return null;
    }
}
