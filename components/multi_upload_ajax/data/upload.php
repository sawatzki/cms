<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}MultiUploadAjax.php";

$obj = new MultiUploadAjax();

if(isset($_POST["action"])){
    $multi_upload_ajax = $obj->read_files();
}else{
    $multi_upload_ajax = $obj->multi_upload_ajax();
}

if($multi_upload_ajax){
    echo true;
}else{
    echo false;
}
