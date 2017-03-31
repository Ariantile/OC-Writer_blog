<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 *
 */
class CommentEntity extends Entity
{
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
     * @var int
     */
    protected $parentId;
    
    /**
     * @var int
     */
    protected $level;
    
    /**
     * @var datetime
     */
    protected $datePosted;
    
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
    
    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @return void
     */
    public function setParentId()
    {
        $this->parentId = $parentId;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return void
     */
    public function setLevel()
    {
        $this->level = $level;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getDatePosted()
    {
        return $this->datePosted;
    }

    /**
     * @return void
     */
    public function setDatePosted()
    {
        $this->datePosted = $datePosted;
        return $this;
    }
    
    public function getUserUrl()
    {
        return '/writer/web/membre/' . $this->user;
    }
    
    public function getArticleUrl()
    {
        return '/writer/web/article/' . $this->article;
    }
}
