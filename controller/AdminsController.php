<?php 
class AdminsController extends Controller{

    public function __construct(){

    }
    public function home(){
        $this->loadView('admins/adminView');
    }
}
?>