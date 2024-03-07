<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
<!--    <link rel="stylesheet" href="assets/dashboard/bootstrap/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/dashboard/css/styles.min.css">
    <link rel="stylesheet" href="/assets/dashboard/css/style.css">
</head>

<body>
<div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
        <!-- Content For Sidebar -->
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="/" class="ms-1">
                    <img src="/assets/img/logo.svg" alt="logo" height="35px" width="35px">
                    <span>ByteBazaar</span>
                </a>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Navigation
                </li>
                <li class="sidebar-item">
                    <a href="/dashboard" class="sidebar-link">
                        <i class="fa-solid fa-list pe-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed" data-bs-target="#users" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-user pe-2"></i>
                        <span>Users</span>
                    </a>
                    <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/users" class="sidebar-link">Manage users</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/users/add" class="sidebar-link">Add user</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed" data-bs-target="#orders" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-basket-shopping pe-2"></i>
                        <span>Orders</span>
                    </a>
                    <ul id="orders" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/orders" class="sidebar-link">View orders</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/orders/add" class="sidebar-link">Place order</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-gamepad pe-2"></i>
                        <span>Products</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/products" class="sidebar-link">View products</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/products/add" class="sidebar-link">Add product</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <button class="btn" id="sidebar-toggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <img src="/image/profile.jpg" class="avatar img-fluid rounded" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="" class="dropdown-item">Profile</a>
                            <a href="/logout" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        {{content}}

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/dashboard/js/script.js"></script>
</body>

</html>
