<?php

use \app\core\Application; ?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="en" style="--bs-primary: #7214ff;--bs-primary-rgb: 114,20,255;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - ByteBazaar</title>
    <link rel="stylesheet" href="/assets/main/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v2/toolkit.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="/assets/main/css/styles.min.css">
    <link rel="stylesheet" href="/assets/main/css/style.css">
</head>

<body>




    <!-- Start: Navbar Centered Links -->
    <nav class="navbar navbar-expand-md sticky-top py-3 navbar-dark" id="mainNav">
        <div class="container">

            <?php if ($success = Application::$app->session->getFlash('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style=" width: 400px; text-align: center; position: absolute; left: calc(50% - 200px); top: 50px;">
                    <?php echo $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($error = Application::$app->session->getFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width: 400px; text-align: center; position: absolute; left: calc(50% - 200px); top: 50px;">
                    <?php echo $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <a class="navbar-brand d-flex align-items-center" href="/">
                <span><img src="/assets/img/logo.svg" width="50" height="50" class="me-2"></span>
                <span class="fs-3">ByteBazaar</span>
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contacts</a></li>
                </ul>
                <?php if (Application::isGuest()) : ?>
                    <span class="navbar-text text-light">
                        <a class="btn btn-primary" href="/login">Login</a>
                        <a class="btn btn-primary" href="/register">Register</a>
                    </span>
                <?php elseif (Application::isAdmin()) : ?>
                    <span class="navbar-text text-light">
                    <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo Application::$app->user->getDisplayName() ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile/cart">Shopping cart</a></li>
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </span>
                <?php else : ?>
                    <span class="navbar-text text-light">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo Application::$app->user->getDisplayName() ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile/cart">Shopping cart</a></li>
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </nav><!-- End: Navbar Centered Links -->

    {{content}}


    <!-- Start: Footer Multi Column -->
    <footer class="bg-dark">
        <div class="container py-4 py-lg-5">
            <div class="row justify-content-center">
                <!-- Start: Social Icons -->
                <div class="col-lg-3 text-center text-lg-start d-flex flex-column align-items-center order-first align-items-lg-start order-lg-last">
                    <div class="fw-bold d-flex align-items-center mb-2">
                        <span><img src="/assets/img/logo.svg" width="25" height="25" class="me-2"></span>
                        <span>ByteBazaar</span>
                    </div>
                    <p class="text-muted">Insert footer here :D</p>
                </div><!-- End: Social Icons -->
            </div>
            <hr>
            <div class="text-muted d-flex justify-content-between align-items-center pt-3">
                <p class="mb-0">Copyright © 2024 ByteBazaar</p>
            </div>
        </div>
    </footer><!-- End: Footer Multi Column -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.reflowhq.com/v2/toolkit.min.js"></script>
    <script src="/assets/main/js/script.min.js"></script>
</body>

</html>
