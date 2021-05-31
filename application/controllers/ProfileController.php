<?php
use \application\controllers\MainController;
class ProfileController extends MainController{
  function __construct(){
    parent::__construct();
    $this->model('auth');
    $this->model('session');

    try {
      $session = SessionManager::getCurrentSession();
      // validate sessionID match with JWT
      if ($session->session_id) {
        $x = $this->session->validateSession($session->username,$session->session_id);
        if($x == 0){
          $this->redirect('login');
        }
      }
    } catch (Exception $exception) {
      $this->redirect('login');
    }
  }

  public function index(){
    $query = $this->auth->selectAll();
    $data = $this->auth->getResult($query);
    $this->template('profile', 'Profile', $data);
  }

  public function update(){
    try {
      $session = SessionManager::getCurrentSession();
    } catch (Exception $exception) {
      $this->redirect('login');
    }
    $data = array();
    $data['password'] = password_hash($_POST['baru'],PASSWORD_BCRYPT);
    $username = $this->validate($_POST['username']);
    $queryx = $this->auth->showUser($username);
    $hash= $queryx[0]['password'];
    $oldPass = password_verify($_POST['lama'],$hash);

    $query= $this->auth->selectWhere(array('username' => $session->username));
    $chek = $this->auth->getResult($query);

    if($chek[0]['password'] != $oldPass){
      echo "Password lama salah!";
    }else{
      $simpan = $this->auth->update($data);
      if($simpan) echo "success";
    }
  }
}
