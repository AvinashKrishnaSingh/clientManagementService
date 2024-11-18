<?php

require_once './config/config.php';

function redirect($location){
    header("Location: " . URLROOT . '/' . $location);
    exit();
}
?>
