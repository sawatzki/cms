<h2>VIEW READ</h2>
<span class="example-show-all">SHOW ALL</span>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/components/example/Example.php";

if (isset($_POST["id"])) {

    $id = $_POST['id'];

    $data = new Todo();
    $note = $data->read($id); ?>


    <h3><?= $note['title']; ?></h3>
    <p><?= $note['description']; ?></p>

<?php } ?>