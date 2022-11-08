<div id="todo">
<?php
echo "!!!!!<hr>";
echo "!!!!!<hr>";
echo "!!!!!<hr>";
echo "!!!!!<hr>";
echo "!!!!!<hr>";
echo "!!!!!<hr>";

include_once $_SERVER['DOCUMENT_ROOT'] . "/components/example/Example.php";

$data = new Todo();
$examples = $data->index();

foreach ($examples as $example) { ?>
    <div><?= $example['title']; ?></div>
    <div><?= $example['description']; ?><span>edit</span></div>
    <hr>

    <input type="text" name="example_title" value="<?= $example['title'] ?>" placeholder="Titel" />
    <input type="text" name="example_description" value="<?= $example['description'] ?>" placeholder="Beschreibung" />
    <button type="button" class="example-upd" value="<?= $example['id'] ?>">OK</button>

<?php } ?>

</div>
