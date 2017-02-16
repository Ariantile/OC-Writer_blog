<?php

namespace App\Entity;

/**
 *
 */
class BookmarkEntity
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
