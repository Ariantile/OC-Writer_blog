<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class ArticleTable extends Table
{
    /*
     * Recupère les derniers écrits
     * @return array
     */
    public function getLast()
    {
        return $this->query("
            SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie
            FROM `article`
            LEFT JOIN `categorie` as categorie
            ON categorie_id = categorie.id
            ORDER BY article.datePublished DESC
        ");
    }
    
    /*
     * Récupères les écrits d'une catégorie
     * @return array
     */
    public function findWithCategorie($id)
    {
        return $this->query("
            SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie
            FROM article
            LEFT JOIN categorie ON categorie_id = categorie.id
            WHERE article.id = ?
        ", [$id], true);
    }
    
    public function countArticles()
    {
        return $this->query("
            SELECT COUNT(id) as allArticles 
            FROM Article
        ");
    }
    
    public function paginateArticles($currentPage)
    {
        $cArt = $this->countArticles();
        $nbArt = $cArt[0]->allArticles;
        $perPage = 4;
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        $pagination = $this->query("
            SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie
            FROM `article`
            LEFT JOIN `categorie` as categorie
            ON categorie_id = categorie.id
            ORDER BY article.datePublished DESC
            LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
        );
        
        $paginateData = array('query' => $pagination, 'cp' => $cp, 'nbPage' => $nbPage);
        
        return $paginateData;
    }
}
