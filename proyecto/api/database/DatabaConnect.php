<?php
require("config/config.php");
class DatabaConnect {
    private $mysqli; 
    
    public function DatabaConnect() {
        $this->mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
    }
    
    public function DBQuery($query) {
        return $this->mysqli->query($query);
    }

    public function getResultJSONEncode($result) {
        $rowsJSON = array();
        while ($row = $result->fetch_assoc()) {
            $rowsJSON[] = $row;
        }
        return json_encode($rowsJSON);   
    }

    public function getLastId() {
    	return $this->mysqli->insert_id;
    }

    public function closeDB() {
    	$this->close();
    }
}
