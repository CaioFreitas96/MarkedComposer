<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\Safebox;
use App\Models\Register;

class View_moreController extends Controller {
    
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
                $this->redirect('safebox');
            }
            
            $request = $request->post();
            $user = $this->session->get('user');
            $safaboxModel = new Safebox();
            $register = new Register();
            $order = $safaboxModel->safebox_id($request['view_more']);
            $user_name = $register->getUser($order[0]['id_user']);
           
            
            $this->view('view_more', ['user' => $user, 'order' => $order[0], 'user_name' => $user_name[0]]);
        
       
    }
}
