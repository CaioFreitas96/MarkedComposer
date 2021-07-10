<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\Safebox;
use App\Models\Make_proposal;

class Make_proposalController extends Controller {

    private $session;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index(Request $request){
       
        if($request->isMethod('get')){
            $user = $this->session->get('user');
            $this->redirect('safebox');
        }else{
            $user = $this->session->get('user');
            $safeboxModel = new Safebox();
            $request = $request->post();
            $order = $safeboxModel->safebox_id($request['make_proposal']);
            
            $this->view('make_proposal', ['user' => $user, 'order' => $order[0]]);
        }    
    }
    public function insert(Request $request){
        $makeModel = new Make_proposal();
        
        $user = $this->session->get('user');

        $imagem = $_FILES["imagem"];
        $post = $request->post();
        $diretorio = "public\upload\proposal".$imagem['name'];
        $id_order = $post['id_order'];
        
        $array = [
            'id_user' => $user['id_user'],
            'nome_produto' => $post['nome_produto'],
            'categoria' => $post['categoria'],
            'preco' => $post['preco'],
            'quantidade' => $post['quantidade'],
            'diretorio' => $diretorio,
            'id_order' => $id_order
            
        ];
        
        if(isset($imagem)){
            
            $diretorio = "public\upload\proposal";
                
            move_uploaded_file($imagem['tmp_name'], $diretorio.$imagem['name']);  
            //echo "Controller <br>";var_dump($array);
            $db = $makeModel->insert($array);
            
            if(is_string($db)){
                
                switch($db){
                    case 'preco vazio':
                        $erro = "Preço vazio";
                        break;
                    case 'quantidade vazio':
                        $erro = "Quantidade vazia";
                        break;
                    
                }

                
                $this->view('make_proposal', ['erro' => $erro, 'user' => $user, 'array' => $array]);

            }else{
                $this->redirect('/indexMarked');
            }



        }else{
            $this->view('make_order', ['erro' => $erro, 'user' => $user, 'array' => $array]);
        }

    } 
}       