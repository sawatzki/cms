<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Example.php";


if (isset($_POST["id"])) {

    $id = $_POST['id'];

    $data = new Example();
    $destroy = $data->destroy($id);

    if($destroy){
        echo true;
    }else{
        echo false;
    }

}
