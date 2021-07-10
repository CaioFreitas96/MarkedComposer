<?php

namespace App\Models;

use Core\Database;

class Make_order{
    
    private $table = 'makeOrder';

    public function insert($post = null){
        
        $db = Database::Getinstance();

        

        if(empty($post['nome_produto'])){
            return "nome vazio";
        }else if(empty($post['descricao'])){
            return "descricao vazio";
        }else if(empty($post['preco'])){
            return "preco vazio";
        }else if(empty($post['imagem'])){
            return "imagem vazia";
        }else{

            $post = [
                'order_name' => $post['nome_produto'],
                'order_description' => $post['descricao'],
                'order_price' => $post['preco'],
                'order_img' => $post['imagem'],
                'categories' => $post['categoria'],
                'path_image' => $post['diretorio'],
                'id_user' => $post['id_user']
            ];

           // var_dump($post);die();

            return $db->insert($this->table, $post);
        }
    }
}