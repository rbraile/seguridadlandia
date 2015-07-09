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

    public function getClienteHogar($id) {
        $query = "SELECT ch.id_hogar, ch.id_cliente, h.calle, h.numero, h.id_zona FROM cliente_hogar as ch INNER JOIN hogar AS h ON ch.id_hogar = h.id WHERE ch.id_cliente = $id";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
        }
        return $resultado;
    }
}