<?php
require_once('database/DatabaConnect.php');
class Usuario {
    private $conection;

    public function Usuario() {
        $this->conection = new DatabaConnect();
    }

    public function loginUser($nombre, $password) {
        $query = "SELECT id, nombre, apellido, email, id_zona, tipo_usuario, telefono, dni, calle, numero 
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
        $query = "INSERT INTO usuario (nombre, apellido, dni, email, telefono, password, id_zona, calle, numero, tipo_usuario ) 
                        VALUES (
                                '$fields->nombre',
                                '$fields->apellido',
                                '$fields->dni',
                                '$fields->email',
                                '$fields->telefono',
                                '$fields->password',
                                '$fields->id_zona',
                                '$fields->calle',
                                '$fields->numero',
                                '$fields->tipo_usuario'
                            )";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getLastId();
    }

    public function getAllUsers() {
        $query = "SELECT id, nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function getAllMonitoreadores() {
        $query = "SELECT id, nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario WHERE tipo_usuario like 'monitoreador'";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function getUserById($id) {
        $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario WHERE id = $id";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function userExist($id) {
        $query = "SELECT 1 FROM usuario WHERE id = $id";
        return $this->conection->DBQuery($query);
    }

    private function isCliente($id) {
        $query = "SELECT COUNT(*) AS count FROM usuario WHERE tipo_usuario = 'cliente' AND id = $id";
        $result = $this->conection->DBQuery($query); 
        return $this->conection->getResultJSONEncode($result); 
    }

    public function editarUsuario($fields) {
        $query = "UPDATE usuario SET 
            nombre = '$fields->nombre', 
            apellido = '$fields->apellido',
            dni = $fields->dni,
            email = '$fields->email',
            telefono = $fields->telefono,
            calle = '$fields->calle',
            numero = $fields->numero
            WHERE id = $fields->id;";
        $this->conection->DBQuery($query);
        return $this->conection->afffectedRows();
    }

    public function deleteUsuario($id) {
        $count = json_decode($this->isCliente($id));

        $query = "DELETE FROM usuario WHERE id = $id;";
        $this->conection->DBQuery($query);
        $result = $this->conection->DBQuery($query);
        
        if($count[0]->count == 1){
           $this->deleteCliente($id);
        } 
        
        return $this->conection->afffectedRows();
    }

    private function deleteCliente($id) {
        $query = "DELETE FROM cliente WHERE id_usuario = $id";
        $result = $this->conection->DBQuery($query);
    }

    public function getUsuarioTel($id) {
        $query = "SELECT telefono FROM usuario WHERE id = $id";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
        }
        return $resultado;
    }

}