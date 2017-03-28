<?php

namespace App\Table;

use Core\Table\Table;

/**
 *
 */
class ForgotTable extends Table
{
    /*
     * Récupères un utilisateur par son code d'activation
     * @return array
     */
    public function findOneForgot($code)
    {
        return $this->query("
            SELECT forgot.id, forgot.user_id, forgot.forgotcode, user.activated, user.email, user.status, user.password
            FROM forgot
            LEFT JOIN user ON user_id = user.id
            WHERE forgot.forgotcode = ?
        ", [$code], true);
    }
}
