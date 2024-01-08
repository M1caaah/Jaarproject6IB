<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet"/>
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img active">
            
          <img src="../assets/images/logos/dark-logo.svg" width="270" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">COMING SOON...</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.php" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">?????</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
      
      <?php
        $mysqli = new MySQLi("localhost", "root", "", "jaarproject");
        /**
         * Connects to the database, prepares and executes a SELECT query to get customer data, 
         * outputs the data in an HTML table, and provides edit and delete options.
         */
        if (mysqli_connect_errno()) {
          trigger_error('Fout bij verbinding: ' . $mysqli->error);
          die();
        }

        $sql = "SELECT * FROM tblklant";
        if (isset($_GET['search_klantnaam']) && !empty($_GET['search_klantnaam'])) {
          $sql .= " WHERE klantnaam LIKE ?";
        }

        if ($stmt = $mysqli->prepare($sql)) {
          
          if (isset($_GET['search_klantnaam']) && !empty($_GET['search_klantnaam'])) {
            $searchTerm = '%' . $_GET['search_klantnaam'] . '%';
            $stmt->bind_param("s", $searchTerm);
          }

          if (!$stmt->execute()) {
            echo 'Het uitvoeren van de query is mislukt: ' . $stmt->error . ' in query:' . $sql;
          } else {
              $stmt->bind_result($KlantID, $Klantnaam, $Klantemail, $Geboortedatum, $Passwoord, $Rol, $Registratiedatum);
              echo '<br><br><form name="form1" method="post" action="' . $_SERVER['PHP_SELF'] . '?actie=wis">';
              echo '<table border="1"><tr><th> Select </th><th> CustomerID </th><th>Name</th><th> Email </th><th>Date of birth</th><th>Password</th><th>Role</th><th>Registration date</th><th>Edit</th></tr>';

              while ($stmt->fetch()) {
                  $teverwijderen = $KlantID;
                  echo '<tr>';
                  echo '<td><input type="checkbox" name="klantids[]" value="' . $teverwijderen . '"></td>';
                  echo '<td>' . $teverwijderen . "</td><td> " . $Klantnaam . "</td><td>" . $Klantemail . "</td><td>" . $Geboortedatum . '</td>';
                  echo '<td>' . $Passwoord . '</td><td>' . $Rol . '</td><td>' . $Registratiedatum . '</td>';
                  
                  echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?actie=edit&klantid=' . $teverwijderen . '">Edit</a></td>';
                  
                  echo '</tr>';
              }

              echo '</table>';
              echo '<input class="btn btn-primary my-3" type="submit" name="btnwissen" id="wis" value="Delete selected items">';
              echo '</form>';
          }

          $stmt->close();
        } else {
          echo 'Er zit een fout in de query: '.$mysqli->error;
        }

        /**
         * Handles customer data for editing based on customer ID from GET parameter. 
         * Prepares SELECT query with customer ID bind parameter.
         * On success, outputs form with fetched data to edit customer.
         * On error, outputs error message.
         */
        if (isset($_GET['actie']) && $_GET['actie'] == 'edit' && isset($_GET['klantid'])) {
            $editSql = "SELECT * FROM tblklant WHERE KlantID = ?";
            
            if ($stmt = $mysqli->prepare($editSql)) {
                $stmt->bind_param("i", $_GET['klantid']);
                
                if ($stmt->execute()) {
                    $stmt->bind_result($KlantID, $Klantnaam, $Klantemail, $Geboortedatum, $Passwoord, $Rol, $Registratiedatum);
                    $stmt->fetch();
                    
                    echo '<div class="card"><div class="card-body"><h5 class="card-title fw-semibold">Update customer</h5>';
                    
                    echo '<form name="editForm" method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="edit_klantid" value="' . $KlantID . '">';
                    echo '<div class="container-fluid"><div class="row">';

                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_klantnaam">Name</label> <input class="form-control" type="text" name="edit_klantnaam" value="' . $Klantnaam . '" required><br>';
                    echo '</div>';

                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_klantemail">Email</label> <input class="form-control" type="text" name="edit_klantemail" value="' . $Klantemail . '" required><br>';
                    echo '</div>';

                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_geboortedatum">Date of birth</label> <input class="form-control" type="text" name="edit_geboortedatum" value="' . $Geboortedatum . '" required><br>';
                    echo '</div>';

                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_passwoord">Password</label> <input class="form-control" type="password" name="edit_passwoord" value="' . $Passwoord . '" required><br>';
                    echo '</div>';

                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_rol">Role<input class="form-control" type="text" name="edit_rol" value="' . $Rol . '" required><br>';
                    echo '</div>';
                    echo '<div class="col-6">';                  
                    echo '<label class="form-label" for="edit_registratiedatum">Registration date<input class="form-control" type="text" name="edit_registratiedatum" value="' . $Registratiedatum . '" required><br>';
                    echo '</div>';
                    
                    echo '</div></div>';
                    echo '<input class="btn btn-primary m-3" type="submit" name="btnUpdate" value="Update">';
                    echo '</form></div></div>';
                } else {
                    echo 'Error fetching data for editing: ' . $stmt->error;
                }

                $stmt->close();
            } else {
                echo 'Error in edit query: ' . $mysqli->error;
            }
        }

        /**
         * Handles deleting selected customers from the database.
         * Builds a DELETE query to delete the customers with the given IDs. 
         * Uses prepare() and bind_param() to sanitize the input.
         * Executes the query and prints a message based on success or failure.
         */
        if (isset($_POST['btnwissen'])) {
            if (isset($_POST['klantids']) && is_array($_POST['klantids'])) {
                $deleteSql = "DELETE FROM tblklant WHERE KlantID IN (" . implode(',', $_POST['klantids']) . ")";

                if ($stmt = $mysqli->prepare($deleteSql)) {
                    if (!$stmt->execute()) {
                        echo 'Het verwijderen van de geselecteerde klanten is mislukt: ' . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo 'Er zit een fout in de delete-query: ' . $mysqli->error;
                }
            } else {
                echo 'Geen klanten geselecteerd om te verwijderen.';
            }
        }
        ?>

        <div class="card">
          <div class="card-body">
            <form name="searchForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="search_klantnaam">Search by Customer Name:</label>
                <input type="text" name="search_klantnaam" id="search_klantnaam">
                <input class="btn btn-primary" type="submit" name="btnSearch" value="Search">
                <?php if (isset($_GET['search_klantnaam']) && !empty($_GET['search_klantnaam'])): ?>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-left: 10px;">Undo Search</a>
                <?php endif; ?>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Add new customer</h5>
            <form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-6">
                    <label class="form-label" for="new_klantnaam">Name:</label>
                    <input class="form-control" type="text" name="new_klantnaam" id="new_klantnaam" required>
                  </div>
                  <div class="col-6">
                    <label class="form-label"   for="new_klantemail">email:</label>
                    <input class="form-control" type="text" name="new_klantemail" id="new_klantemail" required>
                  </div>
                  <div class="col-6">
                    <label class="form-label"   for="new_geboortedatum">Geboortedatum:</label>
                    <input class="form-control" type="text" name="new_geboortedatum" id="new_geboortedatum" required>
                  </div>
                  <div class="col-6">
                    <label class="form-label"  for="new_passwoord">Passwoord:</label>
                    <input class="form-control"type="password" name="new_passwoord" id="new_passwoord" required>
                  </div>
                    <div class="col-6">
                      <label class="form-label"  for="new_rol">Rol</label>
                      <input class="form-control"type="text" name="new_rol" id="new_rol" required>
                    </div>
                    <div class="col-6">
                      <label class="form-label"  for="new_registratiedatum">Registratiedatum:</label>
                      <input class="form-control"type="text" name="new_registratiedatum" id="new_registratiedatum" required>
                    </div>
                  </div>
                </div>
                <input class="btn btn-primary m-3" type="submit" name="btnToevoegen" id="toevoegen" value="Voeg toe">
              </div>
            </form>
          </div>
        </div>
        

        <?php
        /** 
         * Handles adding and updating customers in the database.
         * Prints success or error messages based on query results.
         */
        if (isset($_POST['btnToevoegen'])) {
            $new_klantnaam = $_POST['new_klantnaam'];
            $new_klantemail = $_POST['new_klantemail'];
            $new_geboortedatum = $_POST['new_geboortedatum'];
            $new_passwoord = $_POST['new_passwoord'];
            $new_rol = $_POST['new_rol'];
            $new_registratiedatum = $_POST['new_registratiedatum'];

            $insertSql = "INSERT INTO tblklant (Klantnaam, Klantemail, Geboortedatum, Passwoord, Rol, Registratiedatum) VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $mysqli->prepare($insertSql)) {
                $stmt->bind_param("ssssss", $new_klantnaam, $new_klantemail, $new_geboortedatum, $new_passwoord, $new_rol, $new_registratiedatum);

                if (!$stmt->execute()) {
                    echo 'Het toevoegen van de klant is mislukt: ' . $stmt->error;
                }

                $stmt->close();
            } else {
                echo 'Er zit een fout in de query: ' . $mysqli->error;
            }
        }

        /**
         * Updates an existing customer in the database.
         * Prints success/error messages.
         */
        if (isset($_POST['btnUpdate'])) {
            $edit_klantid = $_POST['edit_klantid'];
            $edit_klantnaam = $_POST['edit_klantnaam'];
            $edit_klantemail = $_POST['edit_klantemail'];
            $edit_geboortedatum = $_POST['edit_geboortedatum'];
            $edit_passwoord = $_POST['edit_passwoord'];
            $edit_rol = $_POST['edit_rol'];
            $edit_registratiedatum = $_POST['edit_registratiedatum'];

            $updateSql = "UPDATE tblklant SET Klantnaam = ?, Klantemail = ?, Geboortedatum = ?, Passwoord = ?, Rol = ?, Registratiedatum = ? WHERE KlantID = ?";

            if ($stmt = $mysqli->prepare($updateSql)) {
                $stmt->bind_param("ssssssi", $edit_klantnaam, $edit_klantemail, $edit_geboortedatum, $edit_passwoord, $edit_rol, $edit_registratiedatum, $edit_klantid);

                if ($stmt->execute()) {
                } else {
                    echo 'Het updaten van de klant is mislukt: ' . $stmt->error;
                }

                $stmt->close();
            } else {
                echo 'Er zit een fout in de update-query: ' . $mysqli->error;
            }
        }
        ?>
        
      
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- MDB -->
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"
  ></script>
</body>

</html>