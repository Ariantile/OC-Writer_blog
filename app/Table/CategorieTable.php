<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class CategorieTable extends Table
{
    /*
     * Récupères une catégorie par id
     * @return array
     */
    public function findOne($id)
    {
        return $this->query("
            SELECT categorie.id, categorie.name
            FROM categorie
            WHERE categorie.id = ?
        ", [$id], true);
    }
    
    /*
     * Cherche si un username ou un email existe déjà
     * @return array
     */
    public function findOneUnique($type, $value)
    {
        return $this->query("
            SELECT categorie.". $type ."
            FROM categorie
            WHERE categorie.". $type ." = ?
        ", [$value], true);
    }
    
    /*
     * Recupère toutes les categories
     * @return array
     */
    public function getAll()
    {    
        return $this->query("
            SELECT categorie.id, categorie.name
            FROM categorie
            ORDER BY categorie.name DESC
        ");
    }
    
    /*
     * Compte toutes les catégories
     * @return int
     */
    public function countCategories()
    {
        return $this->query("
            SELECT COUNT(id) as allCategories
            FROM categorie
        ");
    }
    
    public function paginateCategories($currentPage)
    {
        $cArt = $this->countCategories();
        $nbArt = $cArt[0]->allCategories;
        $perPage = 8;
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        $pagination = $this->query("
            SELECT categorie.id, categorie.name
            FROM `categorie`
            ORDER BY categorie.id DESC
            LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
        );
        
        $paginateData = array('query' => $pagination, 'cp' => $cp, 'nbPage' => $nbPage);
        
        return $paginateData;
    }
}
    