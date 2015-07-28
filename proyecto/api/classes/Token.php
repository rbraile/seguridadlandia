<?php
require_once('database/DatabaConnect.php');

Class Token {

	private $hashToken;
	private $conection;

	public function Token() {
		$this->conection =  new DatabaConnect();
	}

	public function createPasswordToken($string) {
		return md5($string);
	}

	public function createRandomToken() {
	    $key = '';
	    $length = 32;
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }
	    $this->hashToken = $key; 
	    return $this->hashToken;
	}

	public function getHashToken($id) {
		return $this->findTokenUser($id);
	}

	public function findTokenUser($id) {
		$query = "SELECT hashToken FROM token WHERE id = $id ORDER BY id ASC LIMIT 1";
		$result = $this->conection->DBQuery($query);
		$token = $result->fetch_assoc();
		return $token['hashToken']; 
	}
}