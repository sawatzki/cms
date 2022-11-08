<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Example.php";

$obj = new Example();


$data['id'] = $_POST['id'];
$data['title'] = $_POST['title'];
$data['description'] = $_POST['description'];

$update = $obj->update($data);

echo json_encode($data);
