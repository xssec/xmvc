<?php
require_once 'Firebase/JWT.php';
use Firebase\JWT\JWT;

class Session
{

  public function __construct(string $username, string $role, string $session_id)
  {
    $this->username = $username;
    $this->role = $role;
    $this->session_id = $session_id;
  }
}

class SessionManager
{
  public static string $SECRET_KEY = SECRET_KEY;

  public static function login(string $username, string $role, string $session_id)
  {
    if (!empty($username) && !empty($role) && !empty($session_id)) {

      $payload = [
        "session_id" => $session_id, // PR -> simpan di database dan ketika logout delete session_id di database
        "username" => $username,
        "role" => $role
      ];

      $jwt = JWT::encode($payload, SessionManager::$SECRET_KEY, 'HS256');

      $cookie_options = array (
      //'expires' => time() + 60*60*24*30,
      'path' => COOKIE_PATH,
      //'domain' => '.example.com', // leading dot for compatibility or use subdomain
      'secure' => true,     // or false
      'httponly' => true,    // or false
      'samesite' => 'None' // None || Lax  || Strict
      );

      setcookie(COOKIE_NAME, $jwt, $cookie_options);

      return true;
    } else {
      return false;
    }
  }

  public static function getCurrentSession()
  {
    if ($_COOKIE[COOKIE_NAME]) {
      $jwt = $_COOKIE[COOKIE_NAME];

      try {
        $payload = JWT::decode($jwt, SessionManager::$SECRET_KEY, ['HS256']);
        return new Session($payload->username, $payload->role, $payload->session_id);
      } catch (Exception $exception) {
        throw new Exception('User is not login');
      }

    }else {
      throw new Exception('User is not login');
    }

  }
}

?>
