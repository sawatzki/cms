<?php if (isset($_COOKIE['role'])) { ?>

    <?php if (isset($_COOKIE['logged'])) { ?>
        <div class="control-panel">
            <?php if ($_COOKIE['role'] === "root" || $_COOKIE['role'] === "superadmin" || $_COOKIE['role'] === "admin") { ?>
                <?php if ($_COOKIE['role'] === "root" || $_COOKIE['role'] === "superadmin") { ?>
                    <h3>Files multi upload</h3>


                    <div class="container">
                        <h1 align="center">Upload Several Pictures Using Ajax Jquery with PHP </h1>
                        <div align="center">
                            <button type="button" data-toggle="modal" data-target="#src_img_upload" class="btn btn-success btn-lg">Upload Image</button>
                        </div>
                        <br/>
                        <div id="image_gallery">
                            <?php
                            $images = glob("uploads/*.*");
                            foreach($images as $image)
                            {
                                echo '<div class="col-md-2" align="center"><img src="' . $image .'" width="180px" height="180px" style="border:1px dotted #cacaca; margin-top:10px;"/></div>';
                            }
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div id="src_img_upload" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Upload Multiple Files</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="upload_form">
                                        <label>Select Multiple Image</label>
                                        <input type="file" name="images[]" id="img_select" multiple>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <hr>

<?php } ?>
<script>


</script>
