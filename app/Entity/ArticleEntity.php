<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Entité des articles
 */
class ArticleEntity extends Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var datetime
     */
    protected $datePublished;

    /**
     * @var boolean
     */
    protected $published;
    
    /**
     * @var boolean
     */
    protected $commentsActive;
    
    /**
     * @var int
     */
    protected $categorie;

    /**
     * @var int
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * @return void
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @return void
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCommentsActive()
    {
        return $this->commentsActive;
    }

    /**
     * @return void
     */
    public function setCommentsActive($commentsActive)
    {
        $this->commentsActive = $commentsActive;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return void
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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
    
    public function getUrl()
    {
        return '/writer/web/article/' . $this->id . '/1';
    }
    
    public function getExtract()
    {
        $text_extr = strip_tags($this->text);
        
        $html = '<p>' . substr($text_extr, 0, 400) . '...<a href="' .$this->getUrl() .  '" class="index-link-read"> Lire la suite</a></p>';
        return $html;
    }
    
}
