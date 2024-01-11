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
          <span>Clients</span>
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
        <form action="index.php" method="post">
          <div class="input-group">
            <div class="form-outline " data-mdb-input-init>
              <input id="search-input" type="search" id="form1" name="form1" class="form-control " />
              <label class="form-label" for="form1">Search</label>
            </div>
            <button id="search-button" type="submit" name="btnSubmit" class="btn btn-primary btn-rounded"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-primary btn-rounded" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
          Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add customer</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">...</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">

      </div>
    </div>
  </div>
</main>

  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>
