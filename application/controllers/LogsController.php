<?php
use \application\controllers\MainController;
class LogsController extends MainController{
  function __construct(){
    parent::__construct();
    $this->model('logs');
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
    $this->template('logs', 'Logs');
  }

  public function listData(){
    $query = $this->logs->getLogs();
    $list = $this->logs->getResult($query);
    $data = array();
    $no = 0;
    foreach($list as $li){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $li['username'];
      $row[] = $li['ip'];
      $row[] = $li['browser'];
      $row[] = $li['platform'];
      $row[] = $li['system'];
      $row[] = ($li['status'] == 'success') ? '<span class="text-success">'.$li['status'].'</span>':'<span class="text-danger">'.$li['status'].'</span>';
      $row[] = $li['created'];
      $data[] = $row;
    }

    $output = array("data" => $data);
    echo json_encode($output);
  }


  public function listChart(){
    $query = $this->logs->analyzeLogs();
    $result = $this->logs->getResult($query);
    $data = array();
    foreach ($result as $row) {
      extract($row);
      $data[] = ['date'=> $created, 'success' => $Success, 'failed'=> $Failed, 'unknown'=> $Unknown];
    }
    if (empty($result)) {
      echo "Data not found!";
    }
    echo json_encode($data);
  }

  public function listSession(){
    $session = SessionManager::getCurrentSession();
    require_once ROOT."/application/functions/functionAction.php";
    $query = $this->session->selectAll("id", "DESC");
    $list = $this->session->getResult($query);
    $data = array();
    $no = 0;
    foreach($list as $li){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $li['username'];
      if ($session->session_id == $li['sessionID']) {
        $status = ' <small><i class="fas fa-circle fa-xs text-warning"></i></small>';
      } else {
        $status = '';
      }
      $row[] = $li['sessionID'].$status;
      $row[] = $li['created'];
      $row[] = create_action($li['id'],false,true);
      $data[] = $row;
    }

    $output = array("data" => $data);
    echo json_encode($output);
  }

  //Delete Data on Database
  public function delete($id){
    $this->session->delete(array('id'=>$id));
  }

}
