<?php
require("config/config.php");
class DatabaConnect {

    function DatabaConnect() {
        $this->mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        // $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
    }
    
    function DBQuery($query) {
        if ($result = $this->mysqli->query($query)) {
            $rowsJSON = array();
            while ($row = $result->fetch_assoc()) {
              $rowsJSON[] = $row;
            }
            return json_encode($rowsJSON);   
            $result->free();
        }

    }
}
