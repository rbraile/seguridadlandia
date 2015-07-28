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
        return $this->conection->afffectedRows();
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

    public function getAllClient() {
        $query = "SELECT id, nombre, apellido, email, telefono, dni, calle, numero, id_zona FROM usuario WHERE tipo_usuario = 'cliente'";
        $result = $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function getClienteByZona($id_zona) {
        $query = "SELECT cl.visualizacion, us.id, us.nombre, us.apellido, us.email, us.telefono, us.dni, us.calle, us.numero, al.estado, us.id_zona, al.fecha, al.factor_alarma
                FROM usuario AS us INNER JOIN alarma AS al ON us.id = al.id_cliente INNER JOIN cliente AS cl ON us.id = cl.id_usuario WHERE us.tipo_usuario = 'cliente' AND us.id_zona = $id_zona";
        $result = $this->conection->DBQuery($query);
        // return $this->conection->DBQuery($query);
        return $this->conection->getResultJSONEncode($result);
    }

    public function setAlarmaCleinte($id_cliente) {
        $query = "INSERT INTO alarma (id_cliente, estado) VALUES ($id_cliente, 0)";
        return $this->conection->DBQuery($query);
    }

    public function getAlarmaCliente($id_cliente) {
        $query = "SELECT estado, factor_alarma, fecha FROM alarma WHERE id_cliente = $id_cliente ORDER BY fecha DESC limit 1";
        $result = $this->conection->DBQuery($query);
        return $result->fetch_assoc();
    }

    public function getVisualizacion($id) {

        $query = "SELECT visualizacion FROM cliente WHERE id_usuario = $id";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
        }
        return $resultado;
    }

    public function changeVisualizacion($id, $visualizacion) {
        $query = "UPDATE cliente SET visualizacion = $visualizacion WHERE id_usuario = $id";
        $this->conection->DBQuery($query);
        return $this->conection->afffectedRows();
    }

}