<?php
require_once('database/DatabaConnect.php');

class Factura {
    private $id_contrato;
    private $conection;

    public function Factura() {
        $this->conection = new DatabaConnect();
    }

    public function setContratoId($id) {
        $this->id_contrato = $id;
    }

    public function createFacutura($id_contrato) {
        $query = "INSERT INTO factura( id_cliente, detalle, importe, pago, fecha) 
                    VALUES (, "detalle", 10000, 1, 12-12-2014)"
    }

    public getIdClienteByContrato() {
        $query = "SELECT id_cliente FROM contrato WHERE id_contrato = $this->id_contrato";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $result;
        }
        // TODO: en esta me falta traer el id del usuario para crear la factura o cambiar el id por id_contrato es me parece mejor
        // var_dump($resultado);
        return $resultado;
    }

    public function getFacturaInfo() {
        $query = "SELECT * FROM contrato_elemento WHERE id_contrato = $this->id_contrato";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
        }
        return $resultado;
    }
}