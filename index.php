<?php

session_start();

define("ROOT", $_SERVER['DOCUMENT_ROOT']);

$component = "example";

if(isset($_GET['component'])){
    $component = $_GET['component'];
}else{
    $component = "example";
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)) . $ds;

include_once "{$base_dir}layouts{$ds}main.php";