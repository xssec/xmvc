<?php
use \application\controllers\MainController;
class UsersController extends MainController{
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
    $this->template('users', 'Users');
  }

  public function listData(){
    require_once ROOT."/application/functions/functionAction.php";
    $query = $this->auth->showUser();
    //$query = $this->auth->selectAll('id','DESC');
    $list = $this->auth->getResult($query);
    $data = array();
    $no = 0;
    foreach($list as $li){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $li['username'];
      $row[] = $li['fullName'];
      $row[] = $li['email'];
      $row[] = $li['role'];
      $row[] = create_modify($li['id']);
      $data[] = $row;
    }

    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function edit($id){
    $query = $this->auth->selectWhere(array('id'=>$id));
    $data = $this->auth->getResult($query);
    echo json_encode($data[0]);
  }

  public function insert(){
    $data = array();
    $data['username'] = $_POST['username'];
    $data['fullName'] = ucwords($_POST['fullName']);
    $data['email'] = $_POST['email'];
    $data['password'] = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $data['role'] = $_POST['role'];
    $simpan = $this->auth->insert($data);
  }

  public function update(){
    $data = array();
    $data['username'] = $_POST['username'];
    $data['fullName'] = ucwords($_POST['fullName']);
    $data['email'] = $_POST['email'];
    if (empty($_POST['password'])) {
      $data['password'] = $_POST['temp-password'];
    }else {
      $data['password'] = password_hash($_POST['password'],PASSWORD_BCRYPT);
    }
    $data['role'] = $_POST['role'];
    $id = $_POST['id'];
    $simpan = $this->auth->update($data, array('id'=>$id));
  }
}
