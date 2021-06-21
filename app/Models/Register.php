<?php

namespace App\Models;

use Core\Database;



class Register{
    private $table = 'user';

    public function getAll(){
        $db = Database::getInstance();

        
        return $db->getList($this->table, '*');
    }
    public function inserir($post = null){
        
        $db = Database::Getinstance();
               
        if($post == null && empty($post)){
            return false;
        }else{
              
            
            if(empty($post['nome'])){
                
                return "nome vazio";    
                    
            }else if(empty($post['nome_user'])){
                
                return "sobrenome_vazio";

            }else if($email = filter_var($post['email'], FILTER_VALIDATE_EMAIL) ===  false){
                
                return "email invalido";

            }else if(empty($post['pass'])){
                
                return "senha vazia";

            }else{
                
                $post = [
                    //nome banco             nome do formulario
                        'user_name' =>  $post['nome'],
                        'full_name' => $post['nome_user'],
                        'user_email' => filter_var($post['email'], FILTER_VALIDATE_EMAIL),
                        'user_password' => password_hash($post['pass'], PASSWORD_BCRYPT, ["cost" => 10]) 
                    ];

                       
                        return $db->insert($this->table, $post);
                        

            }
        }
    }
    
    public function getEmail($condicao){
        $db = Database::getInstance();
    
        return $db->getList($this->table, '*', ['user_email' => $condicao]);
    }  

}  
