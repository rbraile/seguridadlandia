<?php
require_once('database/DatabaConnect.php');
class Usuario {
    private $conection;

    public function Usuario() {
        $this->conection = new DatabaConnect();
    }

    public function loginUser($nombre, $password) {
        $query = "SELECT id, nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero 
                    FROM usuario 
                    WHERE nombre = '$nombre' 
                    AND password = '$password'";
        
        return $this->conection->DBQuery($query);
    }

    public function setUserToken($id, $hashtoken) {
        $query = "INSERT INTO token (id, hashToken) VALUES ($id, '$hashtoken')";
        return $this->conection->DBQuery($query);
    }

    public function addUser($fields) {
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
        return $this->conection->DBQuery($query);
    }

    public function getAllUsers() {
        $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

}