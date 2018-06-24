<?php

class UserController extends Controller {

	private $user;

	public function __construct() {
		if ( isset($_SESSION['user_id']) ){
			$this->user = new User($_SESSION['user_id']);
		}
	}

	public function profile(){

		if ( ! isset($_SESSION['user_id']) ){
			header('Location: /login' ); exit;
		}

		$user = new User();
		$userData = $user->findById($_SESSION['user_id']);

		$this->render('profile', [
			'ID' => $userData['id'],
			'Username' => $userData['username'],
			'Email' => $userData['email'],
			//'Password' => $userData['password'],
			'Registration date' => $userData['register_date'],
			'Last login date' => $userData['last_login_date']
		]);

	}

	public function login(){

		if ( $_SERVER['REQUEST_METHOD'] !== 'POST' && isset($_SESSION['user_id']) ){
			header('Location: /profile' ); exit;
		}
		else if( $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) ){


			$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$username = $_POST['username'];
			$password = $_POST['password'];

			if ( $username === '' ||  $password === '' ){
				return json_encode([
					'type' => 'error',
					'message' => 'Invalid data!'
				]);
			}

			$user = new User();
			$user->login($username, $password);

		}
		else{
			$this->render('login', [ 'home' => false ]);
		}


	}

	public function register(){

		if( $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) ){

			$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data['username'] = trim($_POST['username']);
			$data['email'] = trim($_POST['email']);
			$data['password'] = trim($_POST['password']);
			$data['password_confirm'] = trim($_POST['password_confirm']);

			if ( $data['username'] === '' ||  $data['email'] === '' || $data['password'] === '' ||
			     $data['password_confirm'] === '' || $data['password'] !== $data['password_confirm'] ){
				echo json_encode([
					'type' => 'error',
					'message' => 'Invalid data!'
				]); exit;
			}

			$user = new User();
			$user->register($data);

		}else{
			$this->render('register', ['home' => false]);
		}


	}

	public function logout(){

		if ( isset($_SESSION['user_id']) ) {
			$this->user->logout();
		}else{
			header('Location: /');
		}
		return;

	}

}