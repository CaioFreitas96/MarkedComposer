<?php

namespace App\Models;

use Core\Database;



class Login{
    
    private $table = 'user';

    public function login($email, $senha){
        $db = Database::getInstance();
       
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);
       
        if($filter === false){
            return "email invalido";
        }else{

            $login = $db->getList($this->table, '*',  ['user_email' => $email]);
            
            if(isset($login[0]['user_email'])){
                $login = $login[0];
                
                if(password_verify($senha, $login['user_password'])){
                    unset($login['user_password']);
                    return $login;
                }else{
                    return false;
                }

            }else{
                return "email errado";
            }
            
        }
    }
}    