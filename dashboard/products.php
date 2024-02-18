<?php
    define("IMGSOURCE", "assets/img/productimages/");
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
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>



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
        <div class="row">
            <div class="col-8">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <div class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input type="search" id="form1" name="search" class="form-control" value="<?php if (isset($_GET['search'])) { echo $_GET['search']; }?>" />
                            <label class="form-label" for="form1">Search</label>
                        </div>
                        <button type="submit" class="btn btn-primary">
								<i class="fas fa-search"></i>
						</button>
						</div>
                    <br>
                    <div class="col-4">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <div class="input-group">
                                <select class="form-select" name="sortBy" aria-label="Sort By">
                                    <option value="name_asc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'name_asc') echo 'selected'; ?>>Name (A-Z)</option>
                                    <option value="name_desc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'name_desc') echo 'selected'; ?>>Name (Z-A)</option>
                                    <option value="price_asc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'price_asc') echo 'selected'; ?>>Price (Low to High)</option>
                                    <option value="price_desc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'price_desc') echo 'selected'; ?>>Price (High to Low)</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sort"></i> Sort
                                    </button>
                            </div>
                        </form>
                    </div>
					<br>
						<span class="me-3">Search by: </span>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio1" value="name" <?php if (isset($_GET['rdbSearch'])) { if ($_GET['rdbSearch'] == "name") { echo "checked"; } } else { echo "checked"; }?>/>
                        <label class="form-check-label" for="inlineRadio1">Name</label>
                        </div>

                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio2" value="price" <?php if (isset($_GET['rdbSearch'])) { if ($_GET['rdbSearch'] == "price") { echo "checked"; } }?>/>
                        <label class="form-check-label" for="inlineRadio2">Price</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary btn-rounded" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
                            Add new product
                        </button>
                </form>
            </div>

                <!-- Add modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form name="addUser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="row g-3">

                                    <div class="col-md-6">
                                        <label for="nameNew" class="form-label">Name:</label>
                                        <input required type="text" name="nameNew" id="nameNew" class="form-control">
                                        <label id="nameCheck"></label>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="priceNew" class="form-label">Price:</label>
                                        <input required type="number" step="0.01" name="priceNew" id="priceNew" class="form-control">
                                        <label id="priceCheck"></label>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="stockNew" class="form-label">Stock:</label>
                                        <input required type="number" step="1" name="stockNew" id="stockNew" class="form-control">
                                        <label id="stockCheck"></label>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="minAgeNew" class="form-label">Minimum age:</label>
                                        <input required type="number" step="1" name="minAgeNew" id="minAgeNew" class="form-control">
                                        <label id="minAgeCheck"></label>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="imageNew" class="form-label">Image:</label>
                                        <input required type="file" accept="image/*" name="imageNew" id="imageNew" class="form-control">
                                        <label id="imageCheck"></label>
                                    </div>

                                    <input type="submit" value="Add product" class="btn btn-primary" name="btnAddProduct">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'products/addproduct.php' ?>
            </div>
        </div>
        <div class="container my-3">
            <?php include 'products/searchproduct.php' ?>
        </div>
    </div>
    </div>
</main>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>