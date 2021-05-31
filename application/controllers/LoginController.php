<?php
class LoginController extends Controller{
  function __construct(){
    $this->model('auth');
    $this->model('logs');
    $this->model('session');

  }

  public function index(){
    // Blocked BruteForce Attempts
    require_once ROOT."/library/netinfo.class.php";
    $env = new NetInfo($_SERVER['HTTP_USER_AGENT']);
    $attempt = $this->logs->bruteforceCheck($env->ip(),MAX_LOGIN_INTERVAL);
    if ($attempt >= MAX_LOGIN_ATTEMPTS) { $this->redirect('blocked');}

    $this->view('login');
  }

  //Method for check username and password from login page
  public function check(){
    if (isset($_POST['email']) AND !empty($_POST['email'])) {
      $email = $this->validate($_POST['email']);
      $queryx = $this->auth->showUserx($email);
      $hash= ($queryx[0]['password'])??'';

      $password = password_verify($_POST['password'],$hash);
      if($password!=1){
        //Logs login attemps
        require_once ROOT."/library/netinfo.class.php";
        $env = new NetInfo($_SERVER['HTTP_USER_AGENT']);
        $logs = array();
        $logs['username'] = $email;
        $logs['ip'] = $env->ip();
        $logs['browser'] = $env->browser();
        $logs['platform'] = $env->platform();
        $logs['system'] = $env->system();
        $logs['status'] = 'failed';
        $logs['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
        $simpan = $this->logs->insert($logs);
        //End of Logs login attemps

        // Blocked BruteForce Attempts
        $attempt = $this->logs->bruteforceCheck($env->ip(),MAX_LOGIN_INTERVAL);
        if ($attempt >= MAX_LOGIN_ATTEMPTS) { $this->redirect('blocked');}

        //redirect to password failed
        $view = $this->view('login');
        $view->bind('msg', 'Username atau Password salah!');

      }else{
        $query = $this->auth->selectWhere(array('email'=>$email, 'password'=>$hash));
        $data = $this->auth->getResult($query);
        $jum = $this->auth->checkUser($email,$hash);

        if($jum>0){
          $data = $data[0];

          $uuid = UUID::v4();
          // Generate JWT Token
          SessionManager::login($data['username'], $data['role'], $uuid);

          $sessionData = array();
          $sessionData['username'] = $data['username'];
          $sessionData['sessionID'] = $uuid;
          $exec = $this->session->insert($sessionData);

          //Logs login attemps
          require_once ROOT."/library/netinfo.class.php";
          $env = new NetInfo($_SERVER['HTTP_USER_AGENT']);
          $logs = array();
          $logs['username'] = $email;
          $logs['ip'] = $env->ip();
          $logs['browser'] = $env->browser();
          $logs['platform'] = $env->platform();
          $logs['system'] = $env->system();
          $logs['status'] = 'success';
          $logs['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
          $simpan = $this->logs->insert($logs);
          //End of Logs login attemps

          $this->redirect('');
        }else{
          $view = $this->view('login');
          $view->bind('msg', 'Username atau Password salah!');
        }
      }
    }else {
      //redirect to password failed
      $view = $this->view('login');
      $view->bind('msg', 'Username atau Password salah!');
    }
  }
}
