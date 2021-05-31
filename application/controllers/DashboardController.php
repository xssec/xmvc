<?php
use \application\controllers\MainController;
class DashboardController extends MainController{
  public function __construct(){
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
    $this->template('dashboard/index');
  }

}
