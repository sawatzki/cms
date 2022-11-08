<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Appointment.php";

$obj = new Appointment();


$data['id'] = $_POST['id'];
$data['title'] = $_POST['title'];
$data['date_time'] = $_POST['dateTime'];
$data['description'] = $_POST['description'];

$update = $obj->update($data);

echo json_encode($data);
