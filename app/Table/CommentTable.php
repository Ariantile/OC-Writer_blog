<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class CommentTable extends Table
{
    /*
     * Récupère un commentaire par id
     * @return int
     */
    public function findCommentById($id)
    {
        return $this->query("
            SELECT comment.id, comment.flag, comment.comment, user.username as username, user.id as user, article.title as title, article.id as article
            FROM comment
            LEFT JOIN user ON user_id = user.id
            LEFT JOIN article ON article_id = article.id
            WHERE comment.id = ?
        ", [$id], true);
    }

    /*
     * Compte tous les commentaires
     * @return int
     */
    public function countComments()
    {
        return $this->query("
            SELECT COUNT(id) as allComments
            FROM Comment
        ");
    }
    
    public function paginateComments($currentPage)
    {
        $cArt = $this->countComments();
        $nbArt = $cArt[0]->allComments;
        $perPage = 10;
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        $pagination = $this->query("
            SELECT comment.id, comment.flag, user.username as username, user.id as user, article.title as title, article.id as article
            FROM `comment`
            LEFT JOIN `article` as article
            ON comment.article_id = article.id
            LEFT JOIN `user` as user
            ON comment.user_id = user.id
            ORDER BY comment.id DESC
            LIMIT " . (($cp - 1) * $perPage) . ", $perPage"
        );
        
        $paginateData = array('query' => $pagination, 'cp' => $cp, 'nbPage' => $nbPage);
        
        return $paginateData;
    }
}
