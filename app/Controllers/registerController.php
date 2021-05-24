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
            $register = $request->post();
            
            $senha = $request->post('pass');
            $confirm_senha = $request->post('confirm_pass');
            
            $email = $request->post('email');
            $select = $registerModel->getEmail($email);
            // var_dump($select);

            if(!empty($select)){

                $this->view('register', ['emailDuplicado' => 'emailDuplicado', 'register' => $register]);
            
            }else if($senha !== $confirm_senha) {
               
                var_dump($senha);
                var_dump($confirm_senha);
                echo "<br>senha diferente";
                $this->view('register', ['senha' => 'senha', 'register' => $register]);
                
            } else{
                
               // var_dump($senha);
               // var_dump($confirm_senha);
               //echo "<br>senha igual<br>";
                
                $db = $registerModel->inserir($register);
                var_dump($db);
                
                if($db === "nome vazio"){

                    $this->view('register', ['nome' => 'nome', 'register' => $register]);
                
                }else if($db === "sobrenome_vazio"){

                    $this->view('register', ['sobrenome' => 'sobrenome', 'register' => $register]);
                
                }else if($db === "email invalido"){

                    $this->view('register', ['emailInvalido' => 'emailInvalido', 'register' => $register]);

                }else if($db === "senha vazia"){
                    $this->view('register', ['senhaVazia' => 'senhaVazia', 'register' => $register]);
                }else{
                    $this->view('login');
                }

            }

            
            

          
        }
        

    }
}