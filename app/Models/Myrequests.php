<?php

namespace App\Models;

use Core\Database;



class Myrequests{
    
    private $table = 'makeOrder';

    public function getAll($id){
       
        $db = Database::getInstance();
       
        return $db->getList($this->table, '*', ['id_user' => $id]);
    }
    public function get($post = null){
       
        $db = Database::getInstance();
       
        return $db->getList($this->table, '*', ['order_name' => $post]);
    }
    public function atualiza($post, $condicao){
       
        $db = Database::getInstance();

        $db->update($this->table, $post, ['id_order' => $condicao]);
    }  
    public function deletar($condicao){
        
        $db = Database::Getinstance();
        if($condicao == null){
            return false;
        }else{
            //var_dump($condicao);die();
            return $db->delete($this->table, ['id_order' => $condicao]);
        }
    }         
            
}    