<?php
require_once('database/DatabaConnect.php');

class Contrato {
	private $basico = array(1 => 1, 2 => 1, 3 => 1, 4 => 3, 5 => 3, 6 => 1);
	private $premiun = array(1 => 1, 2 => 1, 3 => 1, 4 => 3, 5 => 3, 6 => 2 );
	private $gold =  array(1 => 1, 2 => 1, 3 => 1, 4 => 6, 5 => 6, 6 => 3, 7 => 1 );
	private $ip_hogar = '192.168.10.';
	private $lastID = 0;
	private $conection;

	public function Contrato() {
		$this->conection = new DatabaConnect();
	}

	public function setContract( $fields) {
		$this->ip_hogar .= $fields->id_hogar;
		$query = "INSERT INTO contrato (id_cliente, id_hogar, plan, ip_hogar, fecha ) 
						VALUES (
					            '$fields->id_cliente',
					            '$fields->id_hogar',
					            '$fields->plan',
					            '$this->ip_hogar',
					            CURDATE()
							)";	
		$this->conection->DBQuery($query);
    	$this->lastID = $this->conection->getLastId();
    	return $this->lastID;
		
	}

	public function addElements($plan, $idContrato) {
		switch ($plan) {
			case 1:
				$this->addAllElement($this->basico, $idContrato);
					echo $this->conection->getLastId();
				break;
			case 2:
				$this->addAllElement($this->premiun, $idContrato);
					echo $this->conection->getLastId();
				break;
			case 3:
				$this->addAllElement($this->gold, $idContrato);
					echo $this->conection->getLastId();
				break;
			
			default:
				$this->addAllElement($this->basico, $idContrato);
					echo $this->conection->getLastId();
				break;
		}
	}


	private function addAllElement($plan, $idContrato) {
		foreach ($plan as $idElemento => $cantidad) {					
			$query = "INSERT INTO contrato_elemento (id_contrato, id_elemento, cantidad)
						VALUES ( $idContrato, $idElemento, $cantidad)";
			$this->conection->DBquery($query);
		}
	}

}