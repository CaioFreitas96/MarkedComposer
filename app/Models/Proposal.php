<?php

namespace App\Models;

use Core\Database;

class Proposal{
    
    private $table = 'makeProposal';
    private $tableUser = 'user';

    public function select($id){
        
        $db = Database::Getinstance();

        return $db->getList($this->table, '*', ['id_makeorder' => $id]);
        
    }
    public function getUser($condicao){
        $db = Database::getInstance();
    
        return $db->getList($this->tableUser, '*', ['id_user' => $condicao]);
    }  
       
    
}