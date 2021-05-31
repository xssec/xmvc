<?php
class LogsModel extends Model{
   public function __construct(){
      $this->connect();
      $this->_table = "logs";
   }

   public function getLogs(){
     $queryx = "SELECT * from logs ORDER BY id DESC";
     $query=$this->query($queryx);
     $data = $this->getResult($query);
     return $data;
   }

   public function analyzeLogs(){
     $queryx = "SELECT created, COUNT(IF(status='success',1, NULL)) 'Success', COUNT(IF(status='failed',1, NULL)) 'Failed', COUNT(IF(status='',1, NULL)) 'Unknown' FROM logs GROUP BY DATE(created) ORDER BY DATE(created) ASC ";
     $query=$this->query($queryx);
     $data = $this->getResult($query);
     return $data;
   }

   public function bruteforceCheck($ip,$maxLoginInterval){
     $query = "SELECT COUNT(ip) AS failed_login_attempt FROM logs WHERE ip = '".$ip."' AND status = 'failed' AND created BETWEEN DATE_SUB( NOW() , INTERVAL $maxLoginInterval MINUTE ) AND NOW() ";
     $brute = $this->getRows($query);
     return $brute;
   }
}
