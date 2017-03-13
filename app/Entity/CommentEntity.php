<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 *
 */
class CommentEntity extends Entity
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
    protected $comment;

    /**
     * @var boolean
     */
    protected $flag;

    /**
     * @var int
     */
    protected $user;

    /**
     * @var int
     */
    protected $article;

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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return void
     */
    public function setComment()
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @return void
     */
    public function setFlag()
    {
        $this->flag = $flag;
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
    public function setUser()
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return void
     */
    public function setArticle()
    {
        $this->article = $article;
        return $this;
    }
}
