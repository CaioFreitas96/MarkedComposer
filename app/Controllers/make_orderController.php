<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\Make_order;

class Make_orderController extends Controller {
    
    private $session;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index(Request $request) {
        if($request->isMethod('get')){
            $user = $this->session->get('user');
            $this->view('make_order', ['user' => $user, 'get' => 'get']);
        }else{
            $user = $this->session->get('user');
            $make_order = new Make_order;
            
            $imagem = $_FILES["imagem"];
            
            $post = $request->post();

            $diretorio = "public\upload\img".$imagem['name'];
            
                
            
            

            $array = [
                'nome_produto' => $post['nome_produto'],
                'categoria' => $post['categoria'],
                'descricao' => $post['descricao'],
                'preco' => $post['preco'],
                'imagem' => $imagem['name'],
                'diretorio' => $diretorio
            ];
            
            

            if(isset($imagem)){

                
               
                $diretorio = "public\upload\img";
                
                move_uploaded_file($imagem['tmp_name'], $diretorio.$imagem['name']);  
                
                $db = $make_order->insert($array);
                //$this->view('make_order', ['imagem' => $imagem]);

                if(is_string($db)){
                
                    switch($db){
                        case 'nome vazio':
                            $erro = "Nome do produto vazio";
                            break;
                        case 'descricao vazio':
                            $erro = "Descricao vazia";
                            break;
                        case 'preco vazio':
                            $erro = "Sem preço";
                            break;
                        case 'imagem vazia':
                            $erro = "Sem imagem";
                            break;
                    }

                    
                    $this->view('make_order', ['erro' => $erro, 'user' => $user, 'array' => $array]);

                }else{
                    $this->view('indexMarked', ['user' => $user]);
                }

            }else{
                $this->view('make_order', ['erro' => $erro, 'user' => $user, 'array' => $array]);
            }
        }
    }
}
