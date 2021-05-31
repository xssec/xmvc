<?php
class XsModel extends Model{
   public function __construct(){
      $this->connect();
      $this->_table = "xs";
   }

   public function getAttachmentName($id){
     $queryx = "SELECT * FROM 'xs' WHERE id = $id";
     $query=$this->query($queryx);
     $data = $this->getResult($query);
     return $data;
   }
}
