<?php

class HomeController extends Controller {

	public function __construct() {}

	public function index(){

		if ( isset($_SESSION['user_id']) ){
			header('Location: /profile' ); exit;
		}else{
			$this->render('index');
		}

	}

}