<?php
use \application\controllers\MainController;
class BlockedController extends MainController{
  public function __construct(){

  }

  public function index(){
    $this->view('blocked');
  }

}
