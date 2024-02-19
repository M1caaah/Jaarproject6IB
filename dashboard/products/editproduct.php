<?php
/**
 * @var int $id
 * @var string $name
 * @var int $minage
 * @var double $price
 * @var string $stock
 */
?>


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
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<body>

<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group mx-3 mt-4">
                <a href="../index.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user-gear fa-fw me-3"></i>
                    <span>Users</span>
                </a>
                <a href="../products.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                    <i class="fas fa-bag-shopping fa-fw me-3"></i>
                    <span>Products</span>
                </a>
                <a href="../coming-soon.php" class="list-group-item list-group-item-action py-2 ripple">
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
                <img src="../assets/img/logos/logo.png" height="35" alt="" loading="lazy" />
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
<main style="margin-top: 58px">
    <div class="container w-50 pt-5">
        <h1>Edit product</h1>
        <form name="editUser" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="row g-3 editForm">
            <div class="col-md-6">
                <label for="nameUpdate" class="form-label">Name:</label>
                <input required type="text" name="nameUpdate" id="nameUpdate" class="form-control" value="<?php echo $name ?>">
                <label id="nameCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="priceUpdate" class="form-label">Price:</label>
                <input required type="number" step="0.01" name="priceUpdate" id="priceUpdate" class="form-control" value="<?php echo $price ?>">
                <label id="priceCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="stockUpdate" class="form-label">Stock:</label>
                <input required type="number" step="1" name="stockUpdate" id="stockUpdate" class="form-control" value="<?php echo $stock ?>">
                <label id="stockCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="minAgeUpdate" class="form-label">Minimum age:</label>
                <input required type="number" step="1" name="minAgeUpdate" id="minAgeUpdate" class="form-control" value="<?php echo $minage ?>">
                <label id="minAgeCheck"></label>
            </div>
            <input type="hidden" id="id" name="ID-<?php echo $id?>" value="Update">
            <input type="button" value="Update user" class="btn btn-primary" name="btnUpdate" onclick="validateForm()">
        </form>
    </div>
</main>

</body>
</html>
<script>
    function validateForm() {
        let check = true;

        let nameUpdate = document.getElementById("nameUpdate");
        let nameCheck = document.getElementById("nameCheck");
        let priceUpdate = document.getElementById("priceUpdate");
        let priceCheck = document.getElementById("priceCheck");
        let stockUpdate = document.getElementById("stockUpdate");
        let stockCheck = document.getElementById("stockCheck");
        let minAgeUpdate = document.getElementById("minAgeUpdate");
        let minAgeCheck = document.getElementById("minAgeCheck");

        if (nameUpdate.value === "") {
            nameCheck.innerText = "Name is required";
            check = false;
        } else {
            nameCheck.innerText = "";
        }

        if (priceUpdate.value === "") {
            priceCheck.innerText = "Price is required";
            check = false;
        } else if (priceUpdate.value < 0) {
            priceCheck.innerText = "Price cannot be negative";
            check = false;
        } else {
            priceCheck.innerText = "";
        }

        if (stockUpdate.value === "") {
            stockCheck.innerText = "Stock is required";
            check = false;
        } else if (stockUpdate.value < 0) {
            stockCheck.innerText = "Stock cannot be negative";
            check = false;
        } else {
            stockCheck.innerText = "";
        }

        if (minAgeUpdate.value === "") {
            minAgeCheck.innerText = "Minimum age is required";
            check = false;
        } else if (minAgeUpdate.value < 0) {
            minAgeCheck.innerText = "Minimum age cannot be negative";
            check = false;
        } else {
            minAgeCheck.innerText = "";
        }

        if (check) {
            document.editUser.submit();
        }
    }
</script>


