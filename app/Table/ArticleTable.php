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
}
