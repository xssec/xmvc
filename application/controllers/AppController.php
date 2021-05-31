<?php
class AppController extends Controller{
  //Method to access controller on app folder
  private function getController($controller, $action='', $parameter=''){
    $controllerPath = ROOT .'/application/controllers/app/'. ucfirst($controller) .'Controller.php';
    if(file_exists($controllerPath)){
      require_once $controllerPath;
      $controllerName = ucfirst($controller)."Controller";
      $object = new $controllerName();

      $act = ($action!='') ? $action : 'index';
      $param = array($parameter);

      if(method_exists($controllerName, $act)){
        call_user_func_array(array($object, $act), $param);
      }else die(include ROOT .'/public/errors/notfound.php');
    }else die('Controller not found!');
  }

  public function index(){
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
    $this->getController('dashboard');
  }

  public function xs($action='', $parameter=''){
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
    $this->getController('xs', $action, $parameter);
  }

}
