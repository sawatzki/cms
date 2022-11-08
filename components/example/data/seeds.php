<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

include_once "{$base_dir}Example.php";


$obj = new Example();

$data[] = array();

for ($i = 1; $i <= 3333; $i++) {

    $data['title'] = "Title $i";
    $data['description'] = "Generated text: $i. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, earum reiciendis? Atque dolores expedita impedit ipsum porro rem ut, veniam voluptatem? A aperiam expedita hic nihil sequi ullam ut vel. Doloribus illum nam possimus! Asperiores cupiditate deleniti explicabo facilis in magni quasi ratione rerum, sapiente, sequi similique soluta velit veritatis, voluptate voluptatibus? Accusantium adipisci architecto deserunt dolorum expedita id inventore ipsa, modi necessitatibus odit officiis perferendis possimus provident rerum saepe soluta tenetur unde vitae voluptas voluptates voluptatibus.";

    $insert = $obj->seeds($data);
}

echo $insert;


