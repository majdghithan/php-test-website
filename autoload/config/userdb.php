<?php

$host = 'localhost';
$username = 'majd';
$passwordd = '11';
$db = 'coachmajd';

$conn = mysqli_connect($host,$username,$passwordd,$db);

if(!$conn){
    mysqli_connect_error();
    exit();
}
?>