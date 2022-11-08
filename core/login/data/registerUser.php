<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once "{$base_dir}Login.php";

$login = new Login();

$data['login'] = $_POST['login'];
$data['password'] = $_POST['password'];
$data['passwordCheck'] = $_POST['passwordCheck'];

$user = $login->isLoginExist($data);

if($user){
    $data = "User exist!";
}else{
    $data = $login->registerUser($data);
}

echo json_encode($user);