<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;

class PaymentController extends Controller {
    
    private $session;
    public  $payment_request;
    public $nome;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index(Request $request) {

        $payment_request = $request->post();
        
        

        $user = $this->session->get('user');
        $this->view('payment', ['user' => $user, 'payment_request' => $payment_request]);
    }
}
