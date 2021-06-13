<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;

use App\Models\Register;

class RegisterController extends Controller {
    
    public function index(Request $request) {
        if($request->isMethod('get')){
            $this->view('register',['get' => 'get']);
        }else{
            
            $registerModel = new Register(); 
            $post = $request->post();
            
            $senha = $request->post('pass');
            $confirm_senha = $request->post('confirm_pass');
            
            $email = $request->post('email');
            $select = $registerModel->getEmail($email);
            
            if(!empty($select)){
                $this->view('register', ['emailDuplicado' => 'emailDuplicado', 'post' => $post]);
            }else if($senha !== $confirm_senha) {
                $this->view('register', ['senha' => 'senha', 'post' => $post]);
            } else{

                $db = $registerModel->inserir($post);
                
                
                if(is_string($db)){
                    
                    switch($db){
                        case 'nome vazio':
                            $erro = 'Nome vazio';
                            break;
                        case 'sobrenome_vazio':
                            $erro = 'Nome completo vazio';
                            break;
                        case 'email invalido':
                            $erro = 'Email invalido';
                            break;
                        case 'senha vazia':
                            $erro = 'Senha vazia';
                            break;
                    }

                    $this->view('register', ['erro' => $erro, 'post' => $post]);
                }else{
                    $this->view('login');
                }
                          
            }

        }
    
    }
}
