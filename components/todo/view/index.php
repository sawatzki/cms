<div id="todo">
    <?php
    foreach ($rows as $row) { ?>
        <div><?= $row['title']; ?></div>
        <div><?= $row['description']; ?><span>edit</span></div>
        <hr>

        <input type="text" name="example_title" value="<?= $row['title'] ?>" placeholder="Titel"/>
        <input type="text" name="example_description" value="<?= $row['description'] ?>" placeholder="Beschreibung"/>
        <button type="button" class="row-read" value="<?= $row['id'] ?>">read</button>
        <button type="button" class="row-upd" value="<?= $row['id'] ?>">upd</button>
        <button type="button" class="row-del" value="<?= $row['id'] ?>">del</button>

    <?php } ?>
</div>
