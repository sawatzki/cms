<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)) . $ds;

include_once "{$base_dir}Database.php";

class BaseModel extends Database
{

}