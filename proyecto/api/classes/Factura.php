<?php
require_once('database/DatabaConnect.php');

class Factura {
    private $conection;
    private $plan;
    private $importe;
    private $detalle;
   

// 6200 7700 11600 

    public function Factura() {
        $this->conection = new DatabaConnect();
    }

    public function getFacturaByClienteId($id) {
        $query = "SELECT id FROM contrato WHERE id_cliente = $id ORDER BY id DESC LIMIT 1";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultAssoc($result);
            $query = "SELECT fa.id, fa.id_contrato, fa.detalle, fa.importe, fa.pago, fa.fecha, u.nombre, u.apellido, u.calle, u.numero, u.telefono
            FROM factura fa 
            INNER JOIN contrato co ON fa.id_contrato = co.id INNER JOIN usuario u ON co.id_cliente = u.id where fa.id_contrato =" .$resultado["id"];
            $result = $this->conection->DBQuery($query);
            $resultado = false;
            if($result) {
                echo $this->conection->getResultJSONEncode($result);
            } else {
                echo "error al tratar de obtener la factura";
            }

        } else {
            echo "Error al tratar de obtener contrato id";
        }
    
    }

    public function getFactura($id) {
        $query = "SELECT fa.id, fa.id_contrato, fa.detalle, fa.importe, fa.pago, fa.fecha, u.nombre, u.apellido, u.calle, u.numero, u.telefono
        FROM factura fa 
        INNER JOIN contrato co ON fa.id_contrato = co.id INNER JOIN usuario u ON co.id_cliente = u.id where fa.id = $id";

        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
        }
        return $resultado;
    }

    public function createFacutura($id_contrato) {
        $plan = $this->getPlan($id_contrato);
        $this->setPlan($plan);
        $query = "INSERT INTO factura( id_contrato, detalle, importe, pago, fecha) 
                    VALUES ($id_contrato, '$this->detalle', $this->importe, 0, NOW())";
        $this->conection->DBQuery($query);
        return $this->conection->getLastId();
    }

    public function getIdClienteByContrato($id_contrato) {
        $query = "SELECT id_cliente  FROM contrato WHERE id = $id_contrato";
        $result = $this->conection->DBQuery($query);
        $resultado = false;
        if($result) {
            $resultado = $this->conection->getResultJSONEncode($result);
            var_dump($result);
        }
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
    
    private function createDetalle($planes) {
        $detalle="";
        foreach ($planes as $plan) {
            $detalle .= $plan[0] . "," . $plan[1] . "," . $plan[2] . "/";
        }
        return $detalle;
    }

    public function setPlan($plan) {
        switch ($plan) {
            case 1:
                $this->plan = array(array("router centralizado" ,1000 , 1), array("alarma blindada", 2000, 1), array("bateria de sistema de seguridad",500, 1), array("sensor de presencia", 200, 3), array("sensor de cierre de puertas y ventanas", 200, 3), array("camara ip", 1500, 1));
                $this->importe = 6200;
                $this->detalle = $this->createDetalle($this->plan);
                break;
            case 2:
                $this->plan = array(array("router centralizado" ,1000 , 1), array("alarma blindada", 2000, 1), array("bateria de sistema de seguridad",500, 1), array("sensor de presencia", 200, 3), array("sensor de cierre de puertas y ventanas", 200, 3), array("camara ip", 1500, 2));
                $this->importe = 7700;
                $this->detalle = $this->createDetalle($this->plan);
                break;
            case 3:
                $this->plan = array(array("router centralizado" ,1000 , 1), array("alarma blindada", 2000, 1), array("bateria de sistema de seguridad",500, 1), array("sensor de presencia", 200, 3), array("sensor de cierre de puertas y ventanas", 200, 3), array("camara ip", 1500, 3), array("comunicador 3g", 1200, 1));
                $this->importe = 11600;
                $this->detalle = $this->createDetalle($this->plan);
                break;
            
            default:
                $this->plan = array(array("router centralizado" ,1 , 1), array("alarma blindada", 2, 1), array("bateria de sistema de seguridad",3, 1), array("sensor de presencia", 4, 3), array("sensor de cierre de puertas y ventanas", 5, 3), array("camara ip", 6, 1));
                $this->importe = 6200;
                $this->detalle = $this->createDetalle($this->plan);
                break;
       }
    }

    private function getPlan($id_contrato) {
        $query = "SELECT plan FROM contrato WHERE id = $id_contrato";
        $resultado = $this->conection->DBQuery($query);
        $result = $this->conection->getResultJSONEncode($resultado);
        $plan = json_decode($result);
        $id_plan = intval($plan[0]->plan);
        return $id_plan;
    }
}