<?php

class User {

	private $id;
	private $username;
	private $email;
	private $lastLoginDate;
	private $loggedIn = false;
	private $db;

	public function __construct($id = false) {

		$this->db = new DB;

		if( is_integer($id) ){
			$user = $this->findById($id);

			if ( is_array($user) ){
				$this->id = $id;
				$this->username = $user['username'];
				$this->lastLoginDate = $user['last_login_date'];
				$this->loggedIn = true;
			}
		}

		return $this;

	}

	public function login($username, $password) {

		$user = $this->findByUsername($username);

		if ( ! $user ){
			echo json_encode([
				'type' => 'error',
				'message' => $username . ' user not exists!'
			]); exit;
		}

		if ( ! password_verify($password, $user['password']) ) {

			echo json_encode([
				'type' => 'error',
				'message' => 'Wrong password!'
			]); exit;

		}

		//session_start();
		$_SESSION['user_id']    = $user['id'];
		$_SESSION['user_name']  = $user['username'];
		$_SESSION['user_email'] = $user['email'];

		$this->setId($user['id']);
		$this->setUsername($user['username']);
		$this->setEmail($user['email']);
		$this->loggedIn = true;
		$this->setLastLoginDate();

		echo json_encode([
			'type' => 'success',
			'message' => 'Login successful!',
			'data' => $_SESSION
		]);

		//header('Location: /profile');
		return;

	}

	public function register($data){

		if ( $data['username'] === '' ||  $data['password'] === '' || $data['email'] === '' ){

			echo json_encode([
				'type' => 'error',
				'message' => 'Invalid data!'
			]); exit;

		}

		if ( count($this->findByUsername($data['username'])) > 0 ){
			echo json_encode([
				'type' => 'error',
				'message' => 'This username is already in use, please choose another!'
			]); exit;
		}

		$date = date('Y-m-d H:i:s');
		$hashed = password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 12]);

		$dataArray = [
				$data['username'],
				$data['email'],
				$hashed,
				$date,
				$date
		];

		$types = 'sssss';
		$query = "INSERT INTO users (username, email, password, register_date, last_login_date) VALUES (?, ?, ?, ?, ?)";
		$userId = $this->db->query($query, $types, $dataArray);

		if ( is_integer($userId)){
			/*echo json_encode([
				'type' => 'success',
				'message' => 'Registration successful!',
				'data' => [
					'user_id' => $userId
				],
			]); exit;*/

			$this->login($data['username'], $data['password']);
			return;
		}

		echo json_encode([
			'type' => 'error',
			'message' => 'Registration failed!'
		]); exit;

	}

	public function logout(){

		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']);
		$this->loggedIn = false;
		session_destroy();
		header('Location: /');

	}

	public function isLoggedIn(){
		return $this->loggedIn;
	}

	public function findById($id){
		return $this->db->query("SELECT * FROM users WHERE id = ?", 'i', [$id] );
	}

	public function findByUsername($username){
		$userData = $this->db->query("SELECT * FROM users WHERE username = ?", 's', [$username]);
		return $userData;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername( $username ) {
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getLastLoginDate() {
		return $this->lastLoginDate;
	}

	/**
	 *
	 */
	public function setLastLoginDate() {
		$this->lastLoginDate = date('Y-m-d H:i:s');

		$sql = 'UPDATE users SET last_login_date = "'. date('Y-m-d H:i:s') . '" WHERE id = '.  $this->getId();
		$this->db->query($sql);

	}


}