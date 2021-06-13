<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\Login;
use Core\Session;

class LoginController extends Controller {
    
    public function index(Request $request) {
        if($request->isMethod('get')){
            $this->view('login', ['get' => 'get']);
        }else{
            $loginModel = new Login();
            
            $email = $request->post('email');
            $senha = $request->post('senha');

            $login = $loginModel->login($email,$senha);

            switch($login){
                case 'email invalido':
                    $erro = "Email invalido";
                    break;
                case 'email errado':
                    $erro = "Email não cadastrado";
                    break;
                case false:
                    $erro = "Senha invalida";
                    break;

            }
                if(is_array($login)){
                    $session = Session::getInstance();
                    $user = $session->set('user', $login);
                    $this->redirect('indexMarked');
                }else{
                    $this->view('login', ['erro' => $erro]);
                }
                     
        }
    }
    public function logout(){
        $session = Session::getInstance();
        $session->destroy();
        $this->redirect('../login');
    }
}