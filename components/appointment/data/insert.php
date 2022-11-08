<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Appointment.php";

$obj = new Appointment();

$login = $_COOKIE['logged'];
$insert = $obj->insert($login);

if($insert){
    echo true;
}else{
    echo false;
}
