<?php

namespace Core\PaginateNav;

/**
 * Class PaginateNav
 * Permet de gérer la pagination.
 */
class PaginateNav
{
    
    /**
     * Génère et affiche les boutons de pagination
     *
     * @param int $cpage Page courrante
     * @param int $nbPage Nombre de page total
     * @param string $url Url servant à la génération des liens de pagination
     */
    public function getPaginateNav($cpage, $nbPage, $url)
    {
        if ($cpage <= 2 || $nbPage < 5) {
            $min = 1;
        } else if ($cpage == ($nbPage - 1)) {
            $min = $cpage - 3;
        } else if ($cpage == $nbPage){
            $min = $cpage - 4;
        } else {
            $min = $cpage - 2;
        }
            
        if ($cpage <= ($nbPage - 2) && $nbPage >= 5) {
            $limite = $min + 4;
        } else {
            $limite = $nbPage;
        }
        
        if ($cpage <= 1) {
            echo '<span>Précédent</span></a>';
        } else {
            echo '<a href="' . $url . ($cpage -  1) . '"><span>Précédent</span></a>';
        }
        
        for ($i = $min; $i <= $limite; $i++) {
            if ($i == $cpage){
                echo '<span class="bt-pagination-off">' . $i . '</span>';
            } else {
                echo '<a href="' . $url  . $i . ' "><span>'  . $i . '</span></a>';
            }
        }
        
        if ($cpage < $nbPage) {
            echo '<a href="' . $url  . ($cpage +  1) . '"><span>Suivant</span></a> ';
        } else {
            echo '<span>Suivant</span></a> ';
        }
    }
}
?>
