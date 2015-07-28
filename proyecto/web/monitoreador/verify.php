<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!$_SESSION["login"] || $_SESSION["user_type"] != "monitoreador") {
    header("location: /");
}
