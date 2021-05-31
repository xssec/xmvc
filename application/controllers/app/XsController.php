<?php
use \application\controllers\AppMainController;
class XsController extends AppMainController{
  function __construct(){
    parent::__construct();
    $this->model('xs');
  }

  //View Page
  public function index(){
    $this->template('app/xs', 'xs');
  }

  //Ajax Fetch Data
  public function listData(){
    require_once ROOT."/application/functions/functionAction.php";
    $query = $this->xs->selectAll("id", "DESC");
    $list = $this->xs->getResult($query);
    $data = array();
    $no = 0;
    foreach($list as $li){
      $no ++;
      $row = array();
      $row[] = $no;
      $row[] = $li['title'];
      $row[] = $li['description'];
      $row[] = $li['attachment'];
      $row[] = create_action($li['id']);
      $data[] = $row;
    }

    $output = array("data" => $data);
    echo json_encode($output);
  }

  //Fetch Data to Edit Form
  public function edit($id){
    header('Content-Type: application/json');
    $query = $this->xs->selectWhere(array('id'=>$id));
    $data = $this->xs->getResult($query);
    if (!empty($data)) {
      echo json_encode($data[0]);
    }
  }

  //Insert Data to Database
  public function insert(){
    $data = array();
    //print_r($_FILES);
    //exit;
    $dataPost = $_POST['data'];
    parse_str($dataPost,$output);

    $upload = true;
    if ($upload) {
      require_once ROOT."/library/uploader.php";

      $dirpath= ROOT."/public/upload/";
      $uploader = new Uploader();
      $uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx', 'pdf'));  //allowed extensions list//
      $uploader->setMaxSize(10); //set max file size to be allowed in MB//
      $uploader->setDir($dirpath);

      if($uploader->uploadFile('attachment')) { //txtFile is the filebrowse element name //
         $attachment = $uploader->getUploadName(); //get uploaded file name, renames on upload//
         echo $attachment." successfully uploaded";
      }else{  //upload failed
         echo $uploader->getMessage(); //get upload error message
      }
    }

    $data['title'] = $output['title'];
    $data['description'] = addslashes($output['description']);
    $data['attachment'] = $attachment;

    $simpan = $this->xs->insert($data);
  }

  //Update Data to Database
  public function update(){
    $data = array();
    //print_r($_FILES);
    //exit;
    $dataPost = $_POST['data'];
    parse_str($dataPost,$output);

    $upload = true;
    if ($upload) {
      require_once ROOT."/library/uploader.php";

      $dirpath= ROOT."/public/upload/";
      $uploader = new Uploader();
      $uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx', 'pdf'));  //allowed extensions list//
      $uploader->setMaxSize(10); //set max file size to be allowed in MB//
      $uploader->setDir($dirpath);

      if($uploader->uploadFile('attachment')) { //txtFile is the filebrowse element name //
          $attachment  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//
          echo $attachment." successfully uploaded";
          // remove oldfile with new one
          $oldFile = $output['temp-attachment'];
          $ext = pathinfo($oldFile, PATHINFO_EXTENSION);
          unlink($dirpath.'/'.$ext.'/'.$oldFile);
      }else{ //upload failed
          echo $uploader->getMessage(); //get upload error message
          $attachment = $output['temp-attachment']; // if not change use existing file
      }
    }

    $data['title'] = $output['title'];
    $data['description'] = addslashes($output['description']);
    $data['attachment'] = $attachment;

    $id = $output['id'];
    $simpan = $this->xs->update($data, array('id'=>$id));
  }

  //Delete Data on Database
  public function delete($id){
    // get filename before deleted from database
    $upload = true;
    if ($upload) {
      $query = $this->xs->selectWhere(array('id'=>$id));
      $data = $this->xs->getResult($query);
      if (!empty($data)) {
        $dirpath= ROOT."/public/upload/";
        $oldFile = $data[0]['attachment'];
        $ext = pathinfo($oldFile, PATHINFO_EXTENSION);
        unlink($dirpath.'/'.$ext.'/'.$oldFile);
      }
    }

    $hapus = $this->xs->delete(array('id'=>$id));
  }
}
