<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!$_SESSION["login"] || $_SESSION["user_type"] != "admin") {
    header("location: /");
}
?>