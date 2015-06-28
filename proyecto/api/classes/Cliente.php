<?php
require_once('database/DatabaConnect.php');
class Cliente {
    private $conection;

    public function Cliente() {
        $this->conection = new DatabaConnect();
    }

    public function addClienteRelation($visualizacion, $id) {
        $query = "INSERT INTO cliente (visualizacion, id_usuario) VALUES ($visualizacion, $id)";
        return $this->conection->DBQuery($query);
    }
}