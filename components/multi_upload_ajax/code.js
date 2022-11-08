$(document).ready(function () {
    let url = document.location.href;
    let arrView = url.split("=");
    let view = arrView[1];



    function read() {
        $.ajax({
            url: "components/" + view + "/data/upload.php",
            type: "POST",
            dataType: "JSON",
            data: {
                action: "read"
            },
            success: function (data) {


                $('#img_select').val('');
                $('#src_img_upload').modal('hide');

                let out = '';
                for (let i = 2; i < data.length; i++) {
                    out += data[i] + "<br>";
                    out += "<div><img style='width: 200px;' src='/dev/cms3/components/multi_upload_ajax/data/uploads/" + data[i] + "'><div>";
                    out += "<hr/>";
                }
                console.log(out);
                $('#image_gallery').html(out);
            }
        });
    }
    read();

    $(document).on('change','#img_select',function () {
        $('#upload_form').submit();

    });



    $('#upload_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "components/" + view + "/data/upload.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {

                console.log(data);

                $('#img_select').val('');
                $('#src_img_upload').modal('hide');
                $('#image_gallery').html(data);
                read();
            }
        })
    });
});
