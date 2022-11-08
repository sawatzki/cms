<h2>VIEW READ</h2>
<span class="example-show-all">SHOW ALL</span>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/components/example/Example.php";

if (isset($_POST["id"])) {

    $id = $_POST['id'];

    $data = new Todo();
    $note = $data->delete($id); ?>


    <h3><?php print_r($note); ?></h3>

<?php } ?>