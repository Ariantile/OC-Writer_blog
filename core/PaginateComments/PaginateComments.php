<?php

namespace Core\PaginateComments;

use \Datetime;
use \App;

/**
 * Class PaginateNav
 * Affichage et pagination des commentaires
 */
class PaginateComments
{
    
    public function generateComment($c) 
    {
        $date = new DateTime($c->getDatePosted());
        $date = $date->format('d/m/Y H:i');    
            
        if ($c->level == 1) {
            $css_class = 'comment-lvl1';
        } else if ($c->level == 2) {
            $css_class = 'comment-lvl2';
        } else if ($c->level == 3) {
            $css_class = 'comment-lvl3';
        }
        
        if ($c->level <= 2) {
            
            $countReply = App::getInstance()->getTable('Comment')->countCommentReply($c->id);
            
            if ($countReply[0]->allComments > 0) {
                $commentShowReply = '<button id="' . $c->id . '" class="show-reply">Affichier les réponses (' . $countReply[0]->allComments . ')</button>';
            } else {
                $commentShowReply = '';
            }
            
            if (isset($_SESSION['type']) && ($_SESSION['type'] == 'Admin' || $_SESSION['type'] == 'Member')) {
                $replyButton = '<button class="comment-reply" data-id="' . $c->id . '">Répondre</button>';
            } else {
                $replyButton = '';
            }
            
            $commentReply = '<div class="comment-respond">' . $replyButton . '</div><div class="comment-bottom">' . $commentShowReply . '</div>';
            
        } else {
            $commentReply = '';
        }
        
        if ($c->flag == false && (isset($_SESSION['type']) && ($_SESSION['type'] == 'Admin' || $_SESSION['type'] == 'Member')) ) {
            $commentSignal = '<button id="signal-' . $c->id . '" class="comment-signal" data-id="' . $c->id . '"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></button>';
        } else {
            $commentSignal = '<span class="signal-off"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
        }
        
        $commentInfos = '<span class="comment-info">' . htmlspecialchars($c->username) . ' - ' . $date . '</span>';
        $commentHeader = '<div class="comment-head">' . $commentInfos . $commentSignal . '</div>';
        $commentContent = '<p class="comment-content">' . htmlspecialchars($c->comment) . '</p>';

        $html = '<div id="comment-' . $c->id . '" class="' . $css_class . '">' . $commentHeader . $commentContent . $commentReply . '</div>';
        
        return $html;
    }
    
    /**
     */
    public function showComments($comments)
    {
        $first_level    = [];
        
        foreach ($comments as $comment) {
            
            $html = $this->generateComment($comment);
            
            if ($comment->level == 1) {
                $c = array('id' => $comment->id, 'html' => $html);
                array_push($first_level, $c);
            }
        }
        
        foreach($first_level as $first) {
            echo $first['html'];
        }
        
    }
    
    /**
     */
    public function showCommentAjax($comments)
    {
        $first_level    = [];
        
        foreach ($comments as $comment) {
            $html = $this->generateComment($comment);
            $c = array('id' => $comment->id, 'html' => $html);
            array_push($first_level, $c);
        }

        return $first_level;
        
    }
}
?>