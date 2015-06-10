<?php
require("config/config.php");
class DatabaConnect {
    function DatabaConnect() {
        mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Could not connect to MySQL server.');
        mysql_select_db(DB_DATABASE);
    }
}
