<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\Proposal;


class ProposalController extends Controller {
    
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
            $this->redirect('myrequests');
        }
        $user = $this->session->get('user');
        
        $proposalModel = new Proposal;
        $request = $request->post();
        $record = $proposalModel->select($request['id_proposal']);
        
        if(empty($record)){
            $this->view('proposal', ['user' => $user, 'sem_proposal' => 'sem_proposal']);
        }else{
        $user_proposal = $proposalModel->getUser($record[0]['id_user']);
        $this->view('proposal', ['user' => $user, 'record' => $record, 'user_proposal' => $user_proposal]);
        }
    }
}
