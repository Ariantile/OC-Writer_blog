<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class UserTable extends Table
{
    /*
     * Cherche si un username ou un email existe déjà
     * @return array
     */
    public function findOneUnique($type, $value)
    {
        return $this->query("
            SELECT user.". $type ."
            FROM user
            WHERE user.". $type ." = ?
        ", [$value], true);
    }
    
    /*
     * Récupères un utilisateur par son code d'activation
     * @return array
     */
    public function findOneActivation($code)
    {
        return $this->query("
            SELECT user.id, user.activation, user.activated
            FROM user
            WHERE user.activation = ?
        ", [$code], true);
    }
    
    /*
     * Récupères un utilisateur par id
     * @return array
     */
    public function findOne($id)
    {
        return $this->query("
            SELECT user.id, user.username, user.type, user.status
            FROM user
            WHERE user.id = ?
        ", [$id], true);
    }
    
    /*
     * Récupères un utilisateur par email
     * @return array
     */
    public function findOneByEmail($email)
    {
        return $this->query("
            SELECT user.id, user.username, user.type, user.status, user.activated, user.email
            FROM user
            WHERE user.email = ?
        ", [$email], true);
    }
    
    /*
     * Compte le nombre total d'utilisateur
     * @return int
     */
    public function countUsers()
    {
        return $this->query("
            SELECT COUNT(id) as allUsers
            FROM user
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