<!DOCTYPE html>
<html lang="en">
<head>
    <!--Settings-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="vb2007.ddns.net">
    <meta name="description" content="Just another general purpose site.">
    <meta name="author" content="VB2007">
    <meta name="keywords" content="vb2007, ddns, net, free, download, upload, 2022, 2023, 2024">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--3rd party import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--Local import-->
    <link rel="icon" type="image/x-icon" href="asset/media/favicon.ico">
    <link rel="stylesheet" href="../asset/css/design.css">
    <link rel="stylesheet" href="../asset/css/login.css">
    <!--Title-->
    <title>Login</title>
</head>
<body>
    <!--Noscript-->
    <noscript>
        <p>Turn on javascript or get lost.</p>
    </noscript>
    <!--Header-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">vb2007.ddns.net</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                          <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/upload">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/download">Download</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tori-vazlatok">Töri</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a class="btn btn-outline-success mb-2" href="/login">Log in</a>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-outline-success mb-2" href="/register_">Register</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!--Main content-->
    <main id="content" class="container">
        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            continue;
        }
        else{
            echo "<p>You're already logged in.</p>"
            echo "<p>Maybe try <a href='page/_script/logout.php'>logging out</a> first.</p>"
        }
        ?>
        <form id="loginForm" action="/page/_script/login_handler.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center flex-wrap">
                            <div id="form_group" class="form-group form-inline mb-2 mx-2">
                                <label for="username" id="form_label" class="mr-2">Username</label>
                                <input id="username" class="form_field" type="text" name="username"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center flex-wrap">
                            <div id="form_group" class="form-group form-inline mb-2 mx-2">
                                <label for="password" id="form_label" class="mr-2">Password</label>
                                <input id="password" class="form_field" type="password" name="password"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center flex-wrap">
                            <div id="form_group" class="form-group form-inline mb-2 mx-2">
                                <input type="submit" value="Login">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <!--Footer-->
    <footer>
        <p id="footer_text">VB2007 - 2023</p>
    </footer>
    <!--Script import-->
    <script src="../asset/js/login_page_check.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>