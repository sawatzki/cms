$(document).ready(function () {

    let secondLoad = false;


    let role = null;
    if (getCookie("role")) {
        role = getCookie("role")
    }


    let url = document.location.href;
    let arrView = url.split("=");
    let view = arrView[1];

    let inProgress = false;
    let startFrom = 0;
    let rowsCount = 5;

    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !inProgress) {

            fetchRows();
        }
    });

    function nl2br(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        let breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    function fetchRows() {

        if (!view) {
            view = "example";
        }

        if (secondLoad) {
            startFrom = 0;
        }

        $.ajax({
            url: "components/" + view + "/data/index.php",
            type: "post",
            dataType: "json",
            data: {
                startFrom: startFrom,
                rowsCount: rowsCount
            },
            success: function (data) {

                let out = '';

                if (data.length > 0) {

                    $.each(data, function (index, row) {

                            out += "<div class='row' id='row-" + row.id + "'>";
                            out += "<div class='row-value'>";
                            out += "<div id='row-title-" + row.id + "'><b>" + row.title + "</b></div>";
                            out += "<div id='row-description-" + row.id + "'>" + row.description + "</div>";
                            out += "</div>";
                            out += "<div class='cmd-group'>";
                            out += "<button type='button' class='row-read' value='" + row.id + "' data-toggle='modal' data-target='#modal-row-read'>read</button>";

                            if (role) {
                                if (role === "root" || role === "superadmin" || role === "admin" || role === "moderator") {

                                    out += "<button type='button' class='row-edit' value='" + row.id + "'>edit</button>";
                                    if (row.active == 1) {
                                        out += "<button type='button' id='row-delete-" + row.id + "' class='row-delete' act='1' value='" + row.id + "'>off</button>";
                                    } else {
                                        out += "<button type='button' id='row-delete-" + row.id + "' class='row-delete' act='0' value='" + row.id + "'>on</button>";
                                    }

                                    if (role === "root" || role === "superadmin") {
                                        out += "<button type='button' class='row-destroy' value='" + row.id + "'>des</button>";
                                    }
                                }

                            }
                            out += "</div>";

                            out += "<div id='edit-row-" + row.id + "' style='display: none'>";
                            out += "<input type='text' name='row_title_" + row.id + "' class='input-text-edit' value='" + row.title + "' placeholder='Titel'/>";
                            out += "<textarea name='row_description_" + row.id + "'  class='input-text-edit' rows='' cols='' placeholder='Beschreibung'>" + row.description + "</textarea>";
                            out += "<button class='btn-row-update' value='" + row.id + "'>upd</button>";
                            out += "</div>";

                            out += "</div>";

                        }
                    );

                    if (secondLoad) {

                        $(".rows").html(out);

                    } else {
                        $(".rows").append(out);
                    }
                    secondLoad = false
                    inProgress = false;

                    startFrom += 5;

                } else {
                    if ($("#root").height() < 25) {
                        $(".rows").html("No data");
                    }
                }
                $(".spinner-border").css("display", "none");
            },
            beforeSend: function () {
                $(".spinner-border").css("display", "block");
                inProgress = true;
            }
        })
        ;
    }

    fetchRows();

    $(document).on("click", "#row-save", function () {

        let title = $("[name='title']").val().trim();
        let description = $("[name='description']").val().trim();

        $.ajax({
            url: "components/" + view + "/data/insert.php",
            type: "post",
            data: {
                title: title,
                description: description
            },
            success: function (data) {
                if (data) {
                    $("#rows-info").css("display", "block");
                    $(".rows-info").removeClass();
                    $("#rows-info").addClass("rows-info rows-info-success");
                    $("#rows-info").html("Gespeichert");
                    secondLoad = true;
                    fetchRows();
                } else {
                    $("#rows-info").css("display", "block");
                    $(".rows-info").removeClass();
                    $("#rows-info").addClass("rows-info rows-info-error");
                    $("#rows-info").html("NICHT gespeichert !");
                }
            }
        });

    });


    $(document).on("click", ".row-destroy", function () {

        if (window.confirm("Wirklich löschen ?")) {
            if (window.confirm("Ohne Wiederherstellmöglichkeit ?")) {

                let id = $(this).attr("value");

                $.ajax({
                    url: "components/" + view + "/data/destroy.php",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data) {
                            $("#rows-info").css("display", "block");
                            $(".rows-info").removeClass();
                            $("#rows-info").addClass("rows-info rows-info-success");
                            $("#rows-info").html("Row destroyed");
                            $("#row-" + id).slideToggle(function () {
                                if ($(window).height() > $("#view").height()) {
                                    fetchRows();
                                }
                            });
                        } else {
                            $("#rows-info").css("display", "block");
                            $(".rows-info").removeClass();
                            $("#rows-info").addClass("rows-info rows-info-error");
                            $("#rows-info").html("NICHT gelöscht !");
                        }
                    }
                });
            } else {
                return false;
            }
        } else {
            return false
        }
    });


    $(document).on("click", ".row-edit", function () {
        let id = $(this).attr("value");
        $("#edit-row-" + id).slideToggle();
    });

    $(document).on("click", ".btn-row-update", function () {

        let id = $(this).attr("value");
        let title = $("[name='row_title_" + id + "']").val();
        let description = $("[name='row_description_" + id + "']").val();

        $.ajax({
            url: "components/" + view + "/data/update.php",
            type: "post",
            dataType: "json",
            data: {
                id: id,
                title: title,
                description: description
            },
            success: function (data) {
                $("#row-title-" + id).html(data.title);
                $("#row-description-" + id).html(data.description);
            }
        });

    });

    $(document).on("click", ".row-read", function () {

        let id = $(this).attr("value");

        $.ajax({
            url: "components/" + view + "/data/read.php",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {

                let out = "";

                out += "<div class='modal-dialog' role='document'>";
                out += "<div class='modal-content'>";

                out += "<h2 class='text-light text-center'>" + data.title + "</h2>";
                out += "<hr class='hr-light'>";
                out += "<div class='text-light text-center mb-3 p-2'>" + data.description + "</div>";

                out += "<button type='button' class='btns' data-dismiss='modal'>Close</button>";
                out += "</div>";
                out += "</div>";


                $("#modal-row-read").html(out);

            }
        });
    });

    $(document).on("click", ".rows-show-all", function () {

        inProgress = false;
        startFrom = 0;
        rowsCount = 5;

        fetchRows();
    });

    $(document).on("click", ".row-delete", function () {

        if (window.confirm("Wirklich löschen ?")) {

            let id = $(this).attr("value");
            let active = $(this).attr("act");
            let deleteOn = $('#row-delete-' + id).text();

            $.ajax({
                url: "components/" + view + "/data/delete.php",
                type: "post",
                data: {
                    id: id,
                    active: active
                },
                success: function (data) {
                    if (data) {
                        $("#rows-info").css("display", "block");
                        $(".rows-info").removeClass();
                        $("#rows-info").addClass("rows-info rows-info-success");
                        $("#rows-info").html("GELÖSCHT !");

                        if (deleteOn === "on") {
                            $('#row-delete-' + id).text("off");
                        } else {
                            $('#row-delete-' + id).text("on");
                        }

                    } else {

                        $("#rows-info").css("display", "block");
                        $(".rows-info").removeClass();
                        $("#rows-info").addClass("rows-info rows-info-error");
                        $("#rows-info").html("NICHT gelöscht !");

                    }
                }
            });


        } else {
            return false;
        }

    });

    $(document).on("click", ".rows-info", function () {
        $(".rows-info").slideToggle();
    });

    $(document).on("click", ".row-new", function () {
        $(".row-new-form").slideToggle();
    });

    $(document).on("click", ".example-seeder", function () {

        $.ajax({
            url: "components/" + view + "/data/seeds.php",
            success: function () {
                console.log(view + "seeder generated");
                secondLoad = true;
                $(".spinner-border").css("display", "none");
                fetchRows();
            },
            beforeSend: function () {
                $(".spinner-border").css("display", "block");
            }
        });

    });

    $(document).on("click", ".turn-cate", function () {

        if ($(".rows").height() > 30) {

            if (window.confirm("All records DELETE ?")) {
                $.ajax({
                    url: "components/" + view + "/data/turnCate.php",
                    success: function () {
                        $(".spinner-border").css("display", "none");
                        $(".rows").slideToggle(function () {
                            $(".rows").html("No data");
                            alert("All example records was deleted!");
                            window.location.href = window.location.href;
                        });
                    },
                    beforeSend: function () {
                        $(".spinner-border").css("display", "block");
                    }
                });
            } else {
                return false;
            }

        }


    });


})
;
