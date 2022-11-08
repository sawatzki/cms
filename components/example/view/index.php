<?php if (isset($_COOKIE['role'])) { ?>

    <?php if (isset($_COOKIE['logged'])) { ?>
        <div class="control-panel">
            <button type="button" class="btns row-new">ERSTELLEN</button>

            <?php if ($_COOKIE['role'] === "root" || $_COOKIE['role'] === "superadmin" || $_COOKIE['role'] === "admin") { ?>
                <button type="button" class="btns example-seeder">EXAMPLE-SEEDER</button>
                <button type="button" class="btns turn-cate">TURN CATE</button>
                <?php if ($_COOKIE['role'] === "root" || $_COOKIE['role'] === "superadmin") { ?>
                    <button type="button" class="btns user-seeder">USER-SEEDER</button>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <hr>

<?php } ?>
<div class="row-new-form">
    <input name="title" type="text" class="input-text-edit" placeholder="Titel">
    <textarea name="description" class="input-text-edit" type="text" placeholder="Beschreibung"></textarea>
    <input id="row-save" class="btns" value="Speichern"/>
</div>

<div id="root">
    <div class="modal fade" id="modal-row-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
    </div>
    <div class="rows"></div>
</div>
