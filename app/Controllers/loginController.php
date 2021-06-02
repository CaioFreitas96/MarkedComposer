<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\Login;

class LoginController extends Controller {
    
    public function index(Request $request) {
        if($request->isMethod('get')){
            $this->view('login', ['get' => 'get']);
        }else{
            $loginModel = new Login();
            
            $email = $request->post('email');
            $senha = $request->post('senha');

            $login = $loginModel->login($email,$senha);
            
            if($login === "email invalido"){
                $this->view('login',['emailInvalido' => 'emailInvalido', 'email' => $email]);
            }else if($login === "email errado"){
                $this->view('login',['emailErrado' => 'emailErrado', 'email' => $email]);
            }else if($login === false){
                $this->view('login',['senha' => 'senha', 'email' => $email]);
            }else{
                $this->redirect('indexMarked');
            }

        }
    }
}