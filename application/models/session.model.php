<?php
class SessionModel extends Model{
   public function __construct(){
      $this->connect();
      $this->_table = "session";
   }

   public function validateSession($username,$session_id){
     $query = "SELECT count(*) from session where username='".$username."' and sessionID='".$session_id."' ";
     $count =$this->getRows($query);
     return $count;
   }

   public function getSessionID($id){
     $query = "SELECT sessionID from session where id='".$id."' ";
     $count =$this->getRows($query);
     return $count;
   }
}
