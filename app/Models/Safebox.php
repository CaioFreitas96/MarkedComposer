<?php

namespace App\Models;

use Core\Database;

class Safebox{

    private $table = 'makeOrder';

    function safebox(){
        $db = Database::getInstance();

       return $db->getList($this->table, '*');
    }
    function safebox_id($id){
        $db = Database::getInstance();

        return $db->getList($this->table, '*', ['id_order' => $id]);
    }


}