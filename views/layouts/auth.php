<?php use \app\core\Application; ?>
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
</head>

<body>
<!-- Start: Navbar Centered Links -->
<nav class="navbar navbar-expand-md sticky-top py-3 navbar-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <span><img src="assets/img/logo.svg" width="50" height="50" class="me-2"></span>
            <span class="fs-3">ByteBazaar</span>
        </a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
            <?php if (Application::isGuest()): ?>
                <span class="navbar-text">
                    <a class="btn btn-primary" href="/login">Login</a>
                    <a class="btn btn-primary" href="/register">Register</a>
                </span>
            <?php endif; ?>

        </div>
    </div>
</nav><!-- End: Navbar Centered Links -->

<div style="min-height: 100vh;">
    {{content}}
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.reflowhq.com/v2/toolkit.min.js"></script>
<script src="assets/main/js/script.min.js"></script>
</body>

</html>
