<?php
use \application\controllers\AppMainController;
class DashboardController extends AppMainController{
	function __construct(){
	}

	public function index(){
		$this->template('app/dashboard', 'Dashboard');
	}
}
