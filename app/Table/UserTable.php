<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class UserTable extends Table
{
    public function countUsers()
    {
        return $this->query("
            SELECT COUNT(id) as allUsers
            FROM User
        ");
    }
    
    public function paginateUsers($currentPage)
    {
        $cArt = $this->countUsers();
        $nbArt = $cArt[0]->allUsers;
        $perPage = 10;
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        $pagination = $this->query("
            SELECT user.id, user.username, user.type, user.status
            FROM `user`
            ORDER BY user.id DESC
            LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
        );
        
        $paginateData = array('query' => $pagination, 'cp' => $cp, 'nbPage' => $nbPage);
        
        return $paginateData;
    }
}