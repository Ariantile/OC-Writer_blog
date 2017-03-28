<?php

namespace Core\Auth;

use Core\Database;

class DatabaseAuth
{
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function getUserLogged()
    {
        if($this->logged()){
            return $user = array(
                $_SESSION['auth'],
                $_SESSION['username'],
                $_SESSION['email'],
                $_SESSION['type'],
                $_SESSION['status']
            );
        }
        return false;
    }
    
    /**
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login ($username, $password)
    {
        $user = $this->db->prepare('SELECT * FROM user WHERE username = ?', [$username], null, true);

        if($user) {
            if (password_verify($password , $user->password) === true){
                $_SESSION['auth'] = $user->id;
                $_SESSION['username'] = $user->username; 
                $_SESSION['email'] = $user->email;
                $_SESSION['type'] = $user->type;
                $_SESSION['status'] = $user->status;
                return true;
            }
        }
            
        return false;
    }
    
    public function logged()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'Admin') {
            return $_SESSION['type'];
        }
    }
}
