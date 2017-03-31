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
            WHERE article.published = true
            ORDER BY article.datePublished DESC
            LIMIT 8
        ");
    }
 
    /*
     * Récupères un écrit avec sa catégorie
     * @return array
     */
    public function findWithCategorie($id)
    {
        return $this->query("
            SELECT article.id, article.title, article.text, article.datePublished, article.published, article.commentsActive,categorie.name as categorie
            FROM article
            LEFT JOIN categorie ON categorie_id = categorie.id
            WHERE article.id = ?
        ", [$id], true);
    }
    
    /*
     * Compte tous les articles
     * @return int
     */
    public function countArticlesPublic()
    {
        return $this->query("
            SELECT COUNT(id) as allArticles 
            FROM Article
            WHERE article.published = true
        ");
    }
    
    /*
     * Compte tous les articles
     * @return int
     */
    public function countArticles()
    {
        return $this->query("
            SELECT COUNT(id) as allArticles 
            FROM Article
        ");
    }
    
    /*
     * Compte tous les articles d'une catégorie
     * @return int
     */
    public function countArticlesByCategorie($id)
    {
        return $this->query("
            SELECT COUNT(id) as allArticles 
            FROM Article
            WHERE categorie_id = ?
        ", [$id]);
    }
    
    /*
     * Compte tous les articles d'une recherche
     * @return int
     */
    public function countArticlesSearch($key)
    {
        return $this->query("
            SELECT COUNT(article.id) as allArticles
            FROM Article
            LEFT JOIN categorie as categorie 
            ON categorie_id = categorie.id
            WHERE article.title LIKE '%" . $key . "%'
            OR categorie.name LIKE '%" . $key . "%'
        ", [$key]);
    }
    
    public function paginateArticles($currentPage, $type, $id = null, $key = null)
    {
        if ($type == 'all' || $type == 'admin') {
            $cArt = $this->countArticlesPublic();
        } else if ($type == 'cat') {
            $cArt = $this->countArticlesByCategorie($id);
        } else if ($type == 'search') {
            $cArt = $this->countArticlesSearch($key);
        } else if ($type == 'admin') {
            $cArt = $this->countArticles();
        }
        
        $nbArt = $cArt[0]->allArticles;
        $perPage = 4;
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        if ($type == 'all') {
            
            $query = $this->query("
                SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie
                FROM `article`
                LEFT JOIN `categorie` as categorie
                ON categorie_id = categorie.id
                WHERE article.published = true
                ORDER BY article.datePublished DESC
                LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
            );
            
        } else if ($type == 'cat') {
            
            $query = $this->query("
                SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie 
                FROM article
                LEFT JOIN categorie as categorie 
                ON categorie_id = categorie.id
                WHERE categorie.id = ?
                AND article.published = true
                ORDER BY article.datePublished DESC
                LIMIT " . (($cp - 1) * $perPage) . ", $perPage", [$id]
            );
            
        } else if ($type == 'search') {
            
            $query = $this->query("
                SELECT article.id, article.title, article.text, article.datePublished, article.published, categorie.name as categorie 
                FROM article
                LEFT JOIN categorie as categorie 
                ON categorie_id = categorie.id
                WHERE article.title LIKE '%" . $key . "%'
                OR categorie.name LIKE '%" . $key . "%'
                AND article.published = true
                ORDER BY article.datePublished DESC
                LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
            );
            
        } else if ($type == 'admin') {
            $query = $this->query("
                SELECT article.id, article.title, article.text, article.datePublished, article.published, article.commentsActive, categorie.name as categorie
                FROM `article`
                LEFT JOIN `categorie` as categorie
                ON categorie_id = categorie.id
                ORDER BY article.datePublished DESC
                LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
            );
        }
        
        $paginateData = array('query' => $query, 'cp' => $cp, 'nbPage' => $nbPage);
        
        return $paginateData;
    }
}
