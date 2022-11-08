$(document).ready(function(){
    let allowTimes = [];

    for (let i = 0; i <= 23; i++) {
        if (i <= 9) {
            allowTimes.push("0" + i + ":00");
            allowTimes.push("0" + i + ":15");
            allowTimes.push("0" + i + ":30");
            allowTimes.push("0" + i + ":45");
        } else {
            allowTimes.push(i + ":00");
            allowTimes.push(i + ":15");
            allowTimes.push(i + ":30");
            allowTimes.push(i + ":45");

        }
    }

    $("[name='time']").datetimepicker({
        format: 'Y-m-d H:i',
        allowTimes: allowTimes
    });

});



function getCookie(name) {
    let v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return v ? v[2] : null;
}

function setCookie(name, value, days) {
    let d = new Date;
    d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
    document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}

function deleteCookie(name) {
    setCookie(name, '', -1);
}


//MENU-TOP
if ($(document).width() < 1183) {

    $(document).on("mouseout", "#menu-top-mobile-icon", function (e) {
        e.preventDefault();
        $("#menu-top").css({"margin-left": "-195px"});
        $("#menu-top").css({"transition": "ease-in-out 5s"});
    });

    $(document).on("mouseout", "#menu-top", function (e) {
        e.preventDefault();
        $("#menu-top").css({"margin-left": "-195px"});
        $("#menu-top").css({"transition": "ease-in-out 5s"});
    });

    $(document).on("mouseover", "#menu-top-mobile-icon", function (e) {
        e.preventDefault();
        $("#menu-top").css({"margin-left": "0"});
        $("#menu-top").css({"transition": "ease-in-out 0.5s"});
    });

    $(document).on("mouseover", "#menu-top", function (e) {
        e.preventDefault();
        $("#menu-top").css({"margin-left": "0"});
        $("#menu-top").css({"transition": "ease-in-out 0.5s"});
    });
}

// login

$(document).on("click", ".btn-login", function () {

    $("#btn-login-check").css("display", "block");

    if ($("#btn-registration").css("display") === "block") {
        $("#btn-login-check").css("display", "none");
    }

    let out = "";

    out += "<div id='modal-login-form'>";
    out += "<input type='text' name='login' placeholder='Login' value='User1'>";
    out += "<input type='text' name='password' placeholder='Password' value='1234567'>";
    out += "<div class='login-message text-center'></div>"
    out += "</div>";

    $("#modal-body-form").html(out);

});


$(document).on("click", "#choice-login", function () {

    if ($("#modal-login-form").css("display") === "none") {

        $("#choice-login").css("color", "white");
        $("#choice-registration").css("color", "gray");

        $("#modal-login-form").slideToggle();
        $("#modal-registration-form").slideToggle();

        $("#btn-registration").slideToggle(function () {
            $("#btn-login-check").slideToggle();
        });
    }
});

$(document).on("click", "#choice-registration", function () {

    if ($("#modal-registration-form").css("display") === "none") {

        $("#choice-login").css("color", "gray");
        $("#choice-registration").css("color", "white");

        $("#modal-registration-form").slideToggle();
        $("#modal-login-form").slideToggle();

        $("#btn-login-check").slideToggle(function () {
            $("#btn-registration").slideToggle();
        });

    }

});

$(document).on("click", "#btn-registration", function () {

    let registerLogin = $("[name='register-login']").val();
    let registerPassword = $("[name='register-password']").val();
    let registerPasswordCheck = $("[name='register-password-check']").val();

    if (registerPassword === registerPasswordCheck) {

        $.ajax({
            url: "core/login/data/registerUser.php",
            dataType: "json",
            type: "post",
            data: {
                login: registerLogin,
                password: registerPassword,
                passwordCheck: registerPasswordCheck
            },
            success: function (data) {
                if (data) {
                    //user exist

                    if ($(".registration-message").css("display") === "block") {
                        $(".registration-message").slideToggle(function () {
                            $(".registration-message").html("<div class='text-error'>" + registerLogin + " existiert bereits !</div>");
                        });
                    } else {
                        $(".registration-message").html("<div class='text-error'>" + registerLogin + " existiert bereits !</div>");
                    }

                    $(".registration-message").slideToggle();

                } else {
                    //user created

                    if ($(".registration-message").css("display") === "block") {
                        $(".registration-message").slideToggle(function () {
                            $(".registration-message").html("");
                        });
                    }


                    if ($("#modal-login-form").css("display") === "none") {

                        $(".login-message").html("<div class='text-success'>" + registerLogin + " ist registriert. Willkommen ! </div>");

                        $("[name='login']").val(registerLogin);
                        $("[name='password']").val(registerPassword);

                        $("#choice-login").css("color", "white");
                        $("#choice-registration").css("color", "gray");

                        $("#modal-login-form").slideToggle();
                        $("#modal-registration-form").slideToggle();

                        $("#btn-registration").slideToggle(function () {
                            $("#btn-login-check").slideToggle(function () {
                                $(".login-message").slideToggle();
                            });
                        });
                    }

                }

                $(".spinner-border").css("display", "none");
            },
            before: function () {
                $(".spinner-border").css("display", "block");
            }
        });

    } else {
        alert("passwörter sollen gleich sein !");
    }

});


$(document).on("click", ".user-seeder", function () {

    $.ajax({
        url: "core/login/data/userSeeder.php",
        success: function () {
            console.log("user seeder generated");
            $(".spinner-border").css("display", "none");
        },
        start: function () {
            $(".spinner-border").css("display", "block");
        }
    });

});

$(document).on(".theme-light", "click", function () {
    $("body").css({
        "background": "url('resources/images/bg_code.jpg') center center no-repeat fixed",
        "background-size": "cover"
    });
})

$(this).css({
    "background-color": "yellow",
    "font-weight": "bolder"
});
$(document).on("click", ".btn-logout", function () {
    deleteCookie("logged");
    deleteCookie("role");
    window.location.href = window.location.href;
});

$(document).on("click", "#btn-login-check", function () {

    let login = $("[name='login']").val();
    let password = $("[name='password']").val();

    $.ajax({
        url: "core/login/data/checkLogin.php",
        type: "post",
        dataType: "json",
        data: {
            login: login,
            password: password
        },
        success: function (data) {

            if (data) {

                setCookie("logged", data.logged, "7");
                setCookie("role", data.role, "7");

                if ($(".login-message").css("display") === "block") {
                    $(".login-message").slideToggle(function () {
                        window.location.href = window.location.href;
                    });
                } else {
                    window.location.href = window.location.href;
                }

            } else {
                $(".login-message").html("<div class='text-error'>Login oder password ist falsch !</div>");

                if ($(".login-message").css("display") === "none") {
                    $(".login-message").slideToggle();
                }
            }
        }
    });

});


