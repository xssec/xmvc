<?php
use \application\controllers\MainController;
class AuthController extends MainController{
  function __construct(){
    parent::__construct();
    $this->model('auth');
  }

  public function insert(){
    $data = array();
    $data['username'] = $_POST['username'];
    $data['fullName'] = $_POST['fullName'];
    $data['email'] = $_POST['email'];
    $data['password'] = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $simpan = $this->auth->insert($data);
  }
}
