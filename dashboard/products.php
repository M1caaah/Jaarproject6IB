<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<script>
    function validateNewForm(formType) {

        let check = true;

        let nameNew = document.getElementById("nameNew");
        let nameNewCheck = document.getElementById("nameNewCheck");
        let emailNew = document.getElementById("emailNew");
        let emailNewCheck = document.getElementById("emailNewCheck");
        let birthNew = document.getElementById("birthNew");
        let birthNewCheck = document.getElementById("birthNewCheck");
        let passwordNew = document.getElementById("passwordNew");
        let passwordNewCheck = document.getElementById("passwordNewCheck");
        let roleNew = document.getElementById("roleNew");
        let roleNewCheck = document.getElementById("roleNewCheck");


        if (nameNew.value === "") {
            check = false;
            nameNewCheck.innerText = "Please write a name.";
        } else {

        }

        if (emailNew.value === "" || !isValidEmail(emailNew.value)) {
            check = false;
            emailNewCheck.innerText = "Please write a valid email.";
        } else {

        }

        let birthDate = new Date(birthNew.value);
        let today = new Date();
        if (birthNew.value === "") {
            check = false;
            birthNewCheck.innerText = "Please write a date of birth.";
        } else if (birthDate > today) {
            // Check if birth date is later than today
            check = false;
            birthNewCheck.innerText = "Birth date cannot be later than today.";
        }

        if (passwordNew.value === "") {
            check = false;
            passwordNewCheck.innerText = "Please write a password.";
        } else {

        }

        if (roleNew.value === "") {
            check = false
            roleNewCheck.innerHTML = "Please write a role.";
        } else {

        }

        if (check) {
            document.forms.addUser.submit();
        }
    }

    function isValidEmail(email) {
        // Use a regular expression to validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            return false;
        }

        if (!emailRegex.test(email)) {
            return false;
        }

        return true;
    }
</script>

<body>

<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group mx-3 mt-4">
                <a href="index.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-gear fa-fw me-3"></i>
                    <span>Users</span>
                </a>
                <a href="products.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                    <i class="fas fa-bag-shopping fa-fw me-3"></i>
                    <span>Products</span>
                </a>
                <a href="coming-soon.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="far fa-circle-question fa-fw me-3"></i>
                    <span>Coming soon...</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logos/logo.png" height="35" alt="" loading="lazy" />
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">

                <!-- Icon -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://github.com/M1caaah/Jaarproject6IB">
                        <i class="fab fa-github"></i>
                    </a>
                </li>

                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">My profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">

    </div>
</main>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>