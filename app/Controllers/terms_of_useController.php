<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;

class Terms_of_useController extends Controller {
    
    private $session;

    public function __construct(){
        $this->session = Session::getInstance();
        $user = $this->session->get('user');

        if($user == null){
            $this->redirect('login');
        }

    }
    public function index() {

        $user = $this->session->get('user');
        $this->view('terms_of_use', ['user' => $user]);
    }
}
