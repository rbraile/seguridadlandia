<?php
require("config/config.php");
class DatabaConnect {
    private $mysqli; 
    function DatabaConnect() {
        $this->mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
    }
    
    function DBQuery($query) {
        return $this->mysqli->query($query);
    }

    function getResultJSONEncode($result) {
        $rowsJSON = array();
        while ($row = $result->fetch_assoc()) {
            $rowsJSON[] = $row;
        }
        return json_encode($rowsJSON);   
    }
}
