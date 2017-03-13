<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class CategorieTable extends Table
{
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
    
    public function countCategories()
    {
        return $this->query("
            SELECT COUNT(id) as allCategories
            FROM Comment
        ");
    }
    
    public function paginateCategories($currentPage)
    {
        $cArt = $this->countCategories();
        $nbArt = $cArt[0]->allCategories;
        $perPage = 10;
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
    