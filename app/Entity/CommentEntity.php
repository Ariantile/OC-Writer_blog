<?php

namespace App\Entity;

/**
 *
 */
class CommentEntity
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
    protected $user_id;

    /**
     * @var int
     */
    protected $article_id;



    /**
     * @return int
     */
    public function getId():int
    {
        // TODO: implement here
        return 0;
    }

    /**
     * @return string
     */
    public function getComment():string
    {
        // TODO: implement here
        return "";
    }

    /**
     * @return void
     */
    public function setComment():void
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return boolean
     */
    public function getFlag():boolean
    {
        // TODO: implement here
        return false;
    }

    /**
     * @return void
     */
    public function setFlag():void
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return int
     */
    public function getUser():int
    {
        // TODO: implement here
        return 0;
    }

    /**
     * @return void
     */
    public function setUser():void
    {
        // TODO: implement here
        return null;
    }

    /**
     * @return int
     */
    public function getArticle():int
    {
        // TODO: implement here
        return 0;
    }

    /**
     * @return void
     */
    public function setArticle():void
    {
        // TODO: implement here
        return null;
    }
}
