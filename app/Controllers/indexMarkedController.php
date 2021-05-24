<?php
namespace App\Controllers;

use Core\Controller;

class IndexMarkedController extends Controller {
    
    public function index() {
        $this->view('indexMarked');
    }
}
