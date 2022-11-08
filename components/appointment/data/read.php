<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Appointment.php";

if (isset($_POST["id"])) {

    $id = $_POST['id'];

    $data = new Appointment();
    $note = $data->read($id);

    echo json_encode($note);


}
