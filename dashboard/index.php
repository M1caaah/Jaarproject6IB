<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css"></head>

<body>
  
  <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white" >
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
      <a href="index.php" class="list-group-item list-group-item-action rounded-9 py-2 ripple active" aria-current="true">
          <i class="fas fa-user-gear fa-fw me-3"></i>
          <span>Users</span>
        </a>
        <a href="coming-soon.php" class="list-group-item list-group-item-action rounded-9 py-2 ripple">
          <i class="far fa-circle-question fa-fw me-3"></i>
          <span>Coming soon...</span>
        </a>
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
       >
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img
             src="assets/img/logos/logo.png"
             height="35"
             alt=""
             loading="lazy"
             />
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
          <a
             class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
             href="#"
             id="navbarDropdownMenuLink"
             role="button"
             data-mdb-toggle="dropdown"
             aria-expanded="false"
             >
            <img
                 src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                 class="rounded-circle"
                 height="22"
                 alt=""
                 loading="lazy"
                 />
          </a>
          <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuLink"
              >
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
        <form action="index.php" method="get">
          <div class="input-group">
            <div class="form-outline" data-mdb-input-init>
              <input type="search" id="form1" name="search" class="form-control" />
              <label class="form-label" for="form1">Search</label>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </div>
      <div class="col-4">
      <button type="button" class="btn btn-primary btn-rounded" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
        Add new user
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
              <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form name="edituser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row g-3">

                <div class="col-md-6">
                  <label for="nameNew" class="form-label">Name:</label>
                  <input type="text" name="nameNew" id="nameNew" class="form-control" required>
                  <div class="invalid-feedback">
                    Enter a valid name.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="passwordNew" class="form-label">Password:</label>
                  <input type="text" name="passwordNew" id="passwordNew" class="form-control" required>
                  <div class="invalid-feedback">
                    Enter a valid password.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="emailNew" class="form-label">Email:</label>
                  <input type="email" name="emailNew" id="emailNew" class="form-control" required>
                  <div class="invalid-feedback">
                    Vul een geldig e-mailadres.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="rolNew" class="form-label">Role:</label>
                  <input type="text" name="rolNew" id="rolNew" class="form-control" required>
                  <div class="invalid-feedback">
                    Enter a valid role.
                  </div>
                </div>
                
                <div class="col-md-6">
                  <label for="birthNew" class="form-label">Date of birth:</label>
                  <input type="date" name="birthNew" id="birthNew" class="form-control" required>
                  <div class="invalid-feedback">
                    Enter a valid date of birth.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="new_registratiedatum" class="form-label">Registration date:</label>
                  <?php $today = new DateTime();
                  $dateString = $today->format('Y-m-d');
                  ?>
                  <input type="date" name="registrationNew" id="registrationNew" class="form-control" value="<?php echo $dateString ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid registration date.
                  </div>
                </div>
                <input type="submit" value="Add user" class="btn btn-primary" name="btnAdd">
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include 'adduser.php' ?>
      </div>
    </div>
      <div class="container my-3">
        <?php include 'searchresult.php' ?>
      </div>
    </div>
  </div>
</main>

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>
