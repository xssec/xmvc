<?php
use \application\controllers\MainController;
class PreferencesController extends MainController{
  function __construct(){
    parent::__construct();
    $this->model('preferences');
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
    $query = $this->preferences->selectAll();
    $data = $this->preferences->getResult($query);
    $this->template('preferences', 'Preferences', $data);
  }

  public function update(){
    $data = array();
    $data['app_name'] = $_POST['app_name'];
    $data['app_desc'] = $_POST['app_desc'];
    $data['app_copyright'] = $_POST['app_copyright'];
    $data['favicon'] = $_POST['favicon'];
    $data['main_logo'] = $_POST['main_logo'];
    $data['sidebar_logo'] = $_POST['sidebar_logo'];
    $data['footer_logo'] = $_POST['footer_logo'];
    $simpan = $this->preferences->update($data);
    if($simpan) echo "success";
  }
}
