<?php

class Usuario {

	public function addtUser($connection, $nombre, $password) {
		$query = "SELECT id, nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero 
	                FROM usuario 
	                WHERE nombre = '$nombre' 
	                AND password = '$password'";
		
    	return $connection->DBQuery($query);
	}

	public function setUserToken($id, $hashtoke) {
		$query = "INSERT INTO token (id, hashToken) VALUES ($id, '$hashtoken')";
    	return $connection->DBQuery($query);
	}

	public function setUser($connection, $fields) {
		$query = "INSERT INTO usuario (nombre, apellido, dni, email, telefono, password, calle, numero, tipo_usuario ) 
						VALUES (
				                '$fields->nombre',
					            '$fields->apellido',
					            '$fields->dni',
					            '$fields->email',
					            '$fields->telefono',
					            '$fields->password',
					            '$fields->calle',
					            '$fields->numero',
					            '$fields->tipo_usuario'
							)";
    	return $connection->DBQuery($query);
	}

	public function getAllUsers($connection) {
		$query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario";
		$result = $connection->DBQuery($query);
		return $connection->getResultJSONEncode($result);
	}

}