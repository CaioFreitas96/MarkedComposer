<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\Safebox;

class Purchase_confirmationController extends Controller {
    
    private $session;
    public $purchase_request;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index(Request $request) {

            $user = $this->session->get('user');
            $safaboxModel = new Safebox();
            $purchase_request = $request->post();
            ;
            $this->view('purchase_confirmation', ['user' => $user, 'purchase_request' => $purchase_request]);
    }
}
