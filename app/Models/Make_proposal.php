<?php

namespace App\Models;

use Core\Database;

class Make_proposal{
    
    private $table = 'makeProposal';

    public function insert($post = null){
        
        $db = Database::Getinstance();

        if(empty($post['preco'])){
            return "preco vazio";
        }else if(empty($post['quantidade'])){
            return "quantidade vazio";
        }else{
            
            $post = [
                'id_user' => $post['id_user'],
                'proposal_name' => $post['nome_produto'],
                'categories' => $post['categoria'],
                'proposal_price' => $post['preco'],
                'proposal_amount' => $post['quantidade'],
                'proposal_img' => null,
                'path_image' => $post['diretorio'],
                'id_makeorder' => $post['id_order']

            ];
            
            return $db->insert($this->table, $post);
        }
    }
}