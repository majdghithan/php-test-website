<?php

spl_autoload_register('autoload');

function autoload($classname){

    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    include 'classes/'.$classname.'.php';
    include 'config/userdb.php';
}


?>
