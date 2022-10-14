<?php

$host = '//';
$username = '//';
$passwordd = '//';
$db = '//';

$conn = mysqli_connect($host,$username,$passwordd,$db);

if(!$conn){
    mysqli_connect_error();
    exit();
}
?>
