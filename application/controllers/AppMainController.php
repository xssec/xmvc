<?php
namespace application\controllers;
use \Controller;

class AppMainController extends Controller{
  public function __construct(){

  }

  public function template($viewName, $bc='', $data=array()){
    $this->model('preferences');
    $query = $this->preferences->selectAll();
    $datapreferences = $this->preferences->getResult($query);

    $view = $this->view('template');
    $view->bind('viewName', $viewName);
    $view->bind('data', $data);
    $view->bind('preferences', $datapreferences);
  }
}
