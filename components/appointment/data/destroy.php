<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Appointment.php";


if (isset($_POST["id"])) {

    $id = $_POST['id'];

    $data = new Appointment();
    $destroy = $data->destroy($id);

    if($destroy){
        echo true;
    }else{
        echo false;
    }

}
