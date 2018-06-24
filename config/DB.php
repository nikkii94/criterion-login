<?php

class DB {

	private $con;
	private $host       = 'localhost';
	private $db_name    = 'php-login-system';
	private $username   = 'root';
	private $password   = '';


	public function connect() {

		$db = new mysqli($this->host, $this->username, $this->password, $this->db_name);
		$db->set_charset('utf8');

		if ($db->connect_errno) {
			echo "Failed to connect to MySQL: " . $db->connect_error;
			return false;
		}

		$this->con = $db;

		return $this->con;

	}

	public function query($sql, $types = null, $params = null)
	{

		$db = self::connect();
		$stmt = $db->prepare($sql);

		if ($stmt === false) {
			trigger_error($db->error, E_USER_ERROR);
			return;
		}

		if ( is_array($params) ) {

			$a_params[] = & $types;
			for ($i=0; $i < count($params); $i++ ) {
				$a_params[] = & $params[$i];
			}

			call_user_func_array(array($stmt, 'bind_param'), $a_params);
		}
		else if( is_string($types) && is_array($params) ) {
			$stmt->bind_param($types, $params);
		}

		$stmt->execute();

		if( strtolower(substr($sql, 0,  11)) === 'insert into' ) {
			$result = $stmt->insert_id;
		}else{
			$result = $stmt->get_result();
		}


		if( is_object($result) ){
			$result = $result->fetch_assoc();
		}

		$stmt->free_result();
		$stmt->close();
		return $result;

	}

}