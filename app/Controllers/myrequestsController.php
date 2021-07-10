<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use App\Models\Myrequests;
use Core\Request;

class MyrequestsController extends Controller {
    
    private $session;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index(Request $request) {
        $myRequests = new Myrequests;
        $request = $request->post();
        $user = $this->session->get('user');

        if(empty($request)){
            
            $makeOrder = $myRequests->getAll($user['id_user']);
            $this->view('myrequests', ['user' => $user, 'makeOrder' => $makeOrder]);

        }else if(array_key_exists("update", $request)){
                      
           
           $makeOrder = $myRequests->getAll($user['id_user']);
           $condicao = $request['update'];
           unset($request['update']);
           $update = $myRequests->atualiza($request, $condicao);
           $this->redirect('/myrequests');
           
        }
    }

    public function edita(Request $request){
        
        if($request->isMethod('get')){
            $this->redirect('/myrequests');
        }
        $user = $this->session->get('user');
        $myRequests = new Myrequests;

        $botao = $request->post();

        
        $verifica = array_key_exists("edita",$botao);
        
        if($verifica == false){
           
            // "Excluir";
            
            $botao = $request->post();
            $condicao = $botao['excluir'];
            $deleta = $myRequests->deletar($condicao);
            $makeOrder = $myRequests->getAll($user['id_user']);
            
            $this->redirect('/myrequests');
            

        }else{
            
            //Editar

            $makeOrder2 = $myRequests->get($botao['edita']);
            $request = $request->post();
                
            $this->view('myrequests',['user' => $user, 'edita' => 'edita', 'makeOrder2' => $makeOrder2]);
        
        }
        
    }
}
