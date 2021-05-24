<?php

namespace App\Models;

use Core\Database;



class Login{
    
    private $table = 'register';

    public function login($email, $senha){
        $db = Database::getInstance();
       
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);
       
        if($filter === false){
            return "email invalido";
        }else{

            $login = $db->getList($this->table, '*',  ['email' => $email]);
            
            if(isset($login[0]['email'])){
                $login = $login[0];
                
                if(password_verify($senha, $login['senha'])){
                    unset($login['senha']);
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