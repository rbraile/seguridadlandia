<?php
require_once('database/DatabaConnect.php');
class Monitoreador {
    private $conection;

    public function Monitoreador() {
        $this->conection = new DatabaConnect();
    }

    public function addMonitoreador($zona, $id) {
        $query = "INSERT INTO monitoreador (id_zona, id_monitoreador) VALUES ($zona, $id)";
        return $this->conection->DBQuery($query);
    }

    public function getZona($id) {
        $query = "SELECT id_zona FROM monitoreador WHERE id_monitoreador = $id";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultAssoc($result);
    }


    // public function getClienteHogar($id) {
    //     $query = "SELECT ch.id_hogar, ch.id_cliente, h.calle, h.numero, h.id_zona FROM cliente_hogar as ch INNER JOIN hogar AS h ON ch.id_hogar = h.id WHERE ch.id_cliente = $id";
    //     $result = $this->conection->DBQuery($query);
    //     $resultado = false;
    //     if($result) {
    //         $resultado = $this->conection->getResultJSONEncode($result);
    //     }
    //     return $resultado;
    // }

    // public function getAllMonitoreadores() {
    //     $query = "SELECT id, nombre, apellido, email, telefono, dni, calle, numero FROM monitoreador WHERE tipo_usuario = 'monitoreador'";
    //     $result = $this->conection->DBQuery($query);
    //     return $this->conection->getResultJSONEncode($result);
    // }

}