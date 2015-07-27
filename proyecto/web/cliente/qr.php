<?php
    require_once("../lib/phpqrcode-git/lib/full/qrlib.php");
    require_once("../include/verify-cliente.php");
    
    $token = $_SESSION["token"];    
    QRcode::png($token);
