$(document).ready(function () {
    let url = document.location.href;
    let arrView = url.split("=");
    let view = arrView[1];

    $(document).on("click", ".row-read", function () {

        let id = $(this).attr("value");

        $.ajax({
            url: "components/" + view + "/data/read.php",
            type: "post",
            data: {
                id: id
            },
            success: function (data) {
                $("#" + view).html(data);
            }
        });
    });

    function fetch() {
        $.ajax({
            url: "components/" + view + "/data/index.php",
            success: function (data) {
                $("#" + view).html(data);
            }
        });
    }

    $(document).on("click", ".rows-show-all", function () {
        fetch();
    });

    $(document).on("click", ".example-del", function () {

        let id = $(this).attr("value");

        $.ajax({
            url: "components/" + view + "/data/delete.php",
            type: "post",
            data: {
                id: id
            },
            success: function (data) {
                $("#" + view).html(data);
            }
        });
    });

});
