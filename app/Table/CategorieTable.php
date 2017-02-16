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
}
    