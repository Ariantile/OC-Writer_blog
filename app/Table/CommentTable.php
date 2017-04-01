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
    
    public function getCommentsWithParent($parent_id, $cur)
    {
        return $this->query("
            SELECT comment.id, comment.flag, comment.comment, comment.parent_id as parentId, comment.level, comment.datePosted, user.username as username, user.id as userId, article.id as articleId
            FROM `comment`
            LEFT JOIN `article` as article
            ON comment.article_id = article.id
            LEFT JOIN `user` as user
            ON comment.user_id = user.id
            WHERE comment.parent_id = ?
            AND comment.article_id = " . $cur . "
            ORDER BY comment.datePosted ASC
        ", [$parent_id]);
    }
    
    public function getCommentFlag($id, $cur)
    {
        return $this->query("
            SELECT comment.id, comment.flag, comment.level, comment.datePosted, user.username as username, user.id as userId, article.id as articleId
            FROM `comment`
            LEFT JOIN `article` as article
            ON comment.article_id = article.id
            LEFT JOIN `user` as user
            ON comment.user_id = user.id
            WHERE comment.id = ?
            AND comment.article_id = " . $cur . "
            ORDER BY comment.datePosted ASC
        ", [$id], true);
    }
    
    public function checkCommentParent($parent_id)
    {
        return $this->query("
            SELECT comment.id, comment.level, comment.article_id as article
            FROM comment
            WHERE comment.id = ?
        ", [$parent_id], true);
    }
    
    /*
     * Compte tous les commentaires d'un article
     * @return int
     */
    public function countCommentsRead($id)
    {
        return $this->query("
            SELECT COUNT(id) as allComments
            FROM Comment
            WHERE comment.article_id = ?
            AND comment.level = 1
        ", [$id]);
    }
    
    /*
     * Compte toutes les réponse d'un commentaire
     * @return int
    */
    public function countCommentReply($id)
    {
        return $this->query("
            SELECT COUNT(id) as allComments
            FROM Comment
            WHERE comment.parent_id = ?
        ", [$id]);
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
    
    public function paginateComments($currentPage, $type, $articleId = null)
    {
        if ($type == 'admin') {
            $cArt = $this->countComments();
            $nbArt = $cArt[0]->allComments;
            $perPage = 10;
        } else if ($type == 'read' && isset($articleId)) {
            $cArt = $this->countCommentsRead($articleId);
            $nbArt = $cArt[0]->allComments;
            $perPage = 10;
        }
        
        $nbPage = ceil($nbArt/$perPage);
        
        if ($currentPage > 0 && $currentPage <= $nbPage){
            $cp = $currentPage;
        } else {
            $cp = 1;
        }
        
        if ($type == 'admin') {
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
            
        } else if ($type == 'read' && isset($articleId)) {
            $pagination = $this->query("
                SELECT comment.id, comment.flag, comment.comment, comment.parent_id as parentId, comment.level, comment.datePosted, user.username as username, user.id as userId, article.id as articleId
                FROM `comment`
                LEFT JOIN `article` as article
                ON comment.article_id = article.id
                LEFT JOIN `user` as user
                ON comment.user_id = user.id
                WHERE article.id = ?
                AND comment.level = 1
                ORDER BY comment.datePosted ASC
                LIMIT " . (($cp - 1) * $perPage) . ", $perPage", [$articleId]
            );
            
            $paginateData = array('query' => $pagination, 'cp' => $cp, 'nbPage' => $nbPage);
        }
        
        return $paginateData;
    }
}
