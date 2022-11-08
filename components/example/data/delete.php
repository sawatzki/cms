<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Example.php";


if (isset($_POST["id"])) {

    $id = $_POST['id'];
    $active = $_POST['active'];

    if($active == "0"){
        $active = 1;
    }else{
        $active = 0;
    }


    $data = new Example();

    $delete = $data->delete($id, $active);

    if($delete){
        echo true;
    }else{
        echo false;
    }
}
