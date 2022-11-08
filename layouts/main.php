<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CMS</title>



    <?php if ($_SERVER['HTTP_HOST'] == "as"){ ?>

        
    <div style="display: none;">development</div>

        <link rel="stylesheet" href="../resources/css/bootstrap.min.css">

        <!--    https://cdnjs.com/libraries/jquery-datetimepicker-->

        <link rel="stylesheet"

              href="../resources/css/jquery.datetimepicker.min.css">

    <?php }else{ ?>

        <div style="display: none;">production</div>



        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"

              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



        <!--    https://cdnjs.com/libraries/jquery-datetimepicker-->

        <link rel="stylesheet"

              href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">



    <?php } ?>





    <link rel="stylesheet" href="resources/css/style.css">

    <?= file_exists("components/<?= $component ?>/style.css") ? "<link rel='stylesheet' href='components/$component/style.css'>" : "" ?>

    <style>

        body {

            background: url("resources/images/bg_code.jpg") center center no-repeat fixed;

            background-size: cover;

        }

    </style>

</head>

<body>

<div id="wrapper">



    <header class="fixed-top">



        <div class="black-line">

            <?php if (isset($_COOKIE['logged'])): ?>

                <div class="login">

                    <div class="username" data-toggle="collapse" data-target="#black-line-contact">

                        <div><?= isset($_COOKIE['logged']) ? $_COOKIE['logged'] . "[" . $_COOKIE['role'] . "]" : "Gast"; ?></div>

                    </div>

                </div>

            <?php else: ?>

                <div class="login">

                    <span class="btns btn-login" data-toggle="modal" data-target="#loginModal">LOGIN</span>

                </div>

            <?php endif; ?>



            <div id="black-line-contact" class="collapse">

                <div>Contact me</div>

                <div>Whatsapp: +49 1575 8907530</div>

                <div>Email: artsawatzki@gmail.com</div>

                <span class="btns btn-logout">LOGOUT</span>

            </div>

        </div>



        <nav class="navbar navbar-expand-lg as-bg-rgba-dark">



            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"

                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                <span id="menu-top-mobile-icon">

                    <hr><hr><hr>

                </span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">



                    <?php if (isset($_COOKIE['role'])) { ?>

                        <?php if ($_COOKIE['role'] == "root" || $_COOKIE['role'] == "superadmin") { ?>

                            <li class="nav-item">

                                <a class="nav-link col-md-12 pr-3 text-wheat <?= $component === "user" ? "menu-active" : "" ?>"

                                   href="index.php?component=user">USERS</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link col-md-12 pr-3 text-wheat <?= $component === "appointment" ? "menu-active" : "" ?>"

                                   href="index.php?component=multi_upload_ajax">UPLOAD FILES - AJAX</a>

                            </li>

                        <?php } ?>

                    <?php } ?>

                    <li class="nav-item">

                        <a class="nav-link col-md-12 pr-3 text-wheat <?= $component === "example" ? "menu-active" : "" ?>"

                           href="index.php?component=example">MUSTER</a>

                    </li>

                    <?php if (isset($_COOKIE['logged'])): ?>

                        <li class="nav-item">

                            <a class="nav-link col-md-12 pr-3 text-wheat <?= $component === "appointment" ? "menu-active" : "" ?>"

                               href="index.php?component=appointment">TERMINE</a>

                        </li>

                    <?php endif; ?>

                    <li class="nav-item">

                        <a class="nav-link col-md-12 pr-3 text-wheat <?= $component === "contacts" ? "menu-active" : "" ?>"

                           href="index.php?component=contacts">KONTAKT</a>

                    </li>

                </ul>

            </div>



        </nav>



        <div class="d-flex justify-content-center">

            <div class="spinner-border text-light mt-5" role="status">

                <span class="sr-only">Loading...</span>

            </div>

        </div>



    </header>



    <!-- LOGIN REGISTRATION modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

         aria-hidden="true">

        <div id="modal-wrapper-login-registration" class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="login-modal-title" id="choice-login">ANMELDEN</h5>

                    <h5 class="login-modal-title" id="choice-registration">REGISTRIEREN</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div id="modal-registration-form">

                        <input type="text" name="register-login" placeholder="Login">

                        <input type="password" name="register-password" placeholder="Password">

                        <input type="password" name="register-password-check" placeholder="Password widerholen">

                        <div class='registration-message text-center'></div>

                    </div>

                    <div id="modal-login-form">

                        <input type="text" name="login" placeholder="Login" value="Superadmin">

                        <input type="password" name="password" placeholder="Password" value="123123123">

                        <div class='login-message text-center'></div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button id="btn-login-close" type="button" class="btns" data-dismiss="modal">Close</button>

                    <button id="btn-registration" type="button" class="btns">Registrieren</button>

                    <button id="btn-login-check" type="button" class="btns">Anmelden</button>

                </div>

            </div>

        </div>

    </div>

    <div id="rows-info"></div>

    <main>

        <div id="view">

            <?php file_exists("components/$component/controller.php") ? require_once "components/$component/controller.php" : require_once "no_component.php"; ?>

        </div>

    </main>



    <footer>

        <div id="footer" class="as-bg-rgba-dark text-wheat p-3">

            <h3>FOOTER</h3>

            <div>

                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque culpa cumque distinctio ratione totam?

                Alias aliquam assumenda autem corporis deserunt distinctio in ipsam iste laudantium magni nobis

                quibusdam quis quod, ratione vero, voluptatibus.

            </div>

        </div>

        <div class="dark-line">

            <div class="copy-right">© 2020 Artem Sawatzki All Rights Reserved</div>

        </div>

    </footer>



</div>







<?php if ($_SERVER['HTTP_HOST'] == "as"){ ?>

    <script src="../resources/js/jquery.min.js"></script>



    <script src="../resources/js/jquery-ui.min.js"></script>



    <script src="../resources/js/popper.min.js"></script>

    <script src="../resources/js/bootstrap.min.js"></script>



    <script type="text/javascript" src="resources/js/main.js"></script>

    <script type="text/javascript" src="../resources/js/jquery.datetimepicker.full.min.js"></script>

<?php } else { ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"

            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="

            crossorigin="anonymous"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"

            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"

            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"

            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"

            crossorigin="anonymous"></script>



    <script type="text/javascript" src="resources/js/main.js"></script>

    <script type="text/javascript"

            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<?php } ?>



<?= file_exists("components/$component/controller.php") ? "<script src='./components/$component/code.js'></script>" : "" ?>

</body>



</html>

