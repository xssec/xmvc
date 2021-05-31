<?php
class AuthModel extends Model{
   public function __construct(){
      $this->connect();
      $this->_table = "auth";
   }

  public function checkUser($email,$password){
    $query = "SELECT count(*) from auth where email='".$email."' and password='".$password."' ";
    $jum=$this->getRows($query);
    return $jum;
  }

  public	function getNum(){
		$query = "SELECT count(*) from auth";
    $jml_cust=$this->getRows($query);
		return $jml_cust;
	}

  public function showUser(){
    $queryx = "SELECT * from auth";
    $query=$this->query($queryx);
    $data = $this->getResult($query);
    return $data;
  }

  public function getUser(){
    $sesid = $_SESSION['id'];
    $queryx = "SELECT * from auth where (id='$sesid')";
    $query=$this->query($queryx);
    $data = $this->getResult($query);
    return $data;
  }

  public function showUserx($mail){
    $queryx = "SELECT * from auth where email='$mail'";
    $query=$this->query($queryx);
    $data = $this->getResult($query);
    return $data;
  }

  public function showUserz($uname){
    $queryx = "SELECT * from auth where email='$uname'";
    $query=$this->query($queryx);
    $data = $this->getResult($query);
    return $data;
  }

}
