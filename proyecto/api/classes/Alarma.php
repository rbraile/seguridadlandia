<?php
require_once('database/DatabaConnect.php');
class Alarma {
    private $conection;

    public function Alarma() {
        $this->conection = new DatabaConnect();
    }

    public function changeAlarmaState($id_cliente, $state) {
        $query = "UPDATE alarma SET estado = $state WHERE id_cliente = $id_cliente";
        $this->conection->DBQuery($query);
    }

    public function getAlarmaState($id_cliente) {
        $query = "SELECT estado FROM alarma WHERE id_cliente = $id_cliente";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);

    }

    public function hitorialAlarma($id_cliente, $factor) {
        $query = "INSERT INTO historial_alarma (id_cliente, factor_alarma, fecha) VALUES ($id_cliente, '$factor', NOW())";
        $this->conection->DBQuery($query);
        echo $this->conection->afffectedRows();
    }

    public function getAllAlarmas() {
        $query = "SELECT * FROM historial_alarma";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function getAllAlarmasBy($tipo, $dato) {
        $query = "SELECT * FROM historial_alarma WHERE $tipo='$dato'";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function getAllAlarmasByFecha() {
        $query = "SELECT count(*) AS cantidad, fecha FROM historial_alarma GROUP BY fecha";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

}