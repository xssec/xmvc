<?php
class LogoutController extends Controller{
  public function index(){
    $this->model('session');
    try {
      $session = SessionManager::getCurrentSession();
      // Remove sessionID from Session Database
      if ($session->session_id) {
        $this->session->delete(array('sessionID'=>$session->session_id));
      }
    } catch (Exception $exception) {
      $this->redirect('login');
    }
    setcookie(COOKIE_NAME, 'LOGOUT');
    $this->redirect('/');
  }
}
