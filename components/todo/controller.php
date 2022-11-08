<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/$component/Todo.php";

$data = new Todo();
$rows = $data->index();

require_once "components/$component/view/index.php";
