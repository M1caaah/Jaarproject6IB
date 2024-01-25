<?php
  include 'connection.php';
  $mysql = new MySQLi($server,$user,$password,$database);
  
  //This is a interesting way fix the charset problem. I should change it in the database. But it works for now.
  $mysql->set_charset("utf8mb4"); 

  if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
  }

  if (isset($_GET['search'])) {
    
    // Prepare the search statement statement.
    $searchTerm = $_GET['search'];
    $searchTerm = mysqli_real_escape_string($mysql,$searchTerm);
    $searchTerm = htmlspecialchars($searchTerm);
    $searchTerm = trim($searchTerm);
    $searchTerm = strtolower($searchTerm);
    $searchTerm = "%".$searchTerm."%";

    // Prepare the SQL statement.
    if ($_GET['rdbSearch'] == 'name') {
		$sql = "SELECT * FROM `tblklant` WHERE `klantnaam` LIKE ? AND `active` = 1";
	}
	else if ($_GET['rdbSearch'] == 'email') {
		$sql = "SELECT * FROM `tblklant` WHERE `klantemail` LIKE ? AND `active` = 1";
	}
	else {
		$sql = "SELECT * FROM `tblklant` WHERE `rol` LIKE ? AND `active` = 1";
	}
    // Prepare the statement.
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('s',$searchTerm);
  }
  else {
    
    // Prepare the SQL statement.
    $sql = "SELECT * FROM `tblklant` WHERE `active` = 1";

    // Prepare the statement.
    $stmt = $mysql->prepare($sql);

  }
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo '<div class="row">';
    while($row = $result->fetch_assoc()) {
      ?>
      <div class="col-md-4 col-sm-6 col-12">
        <div class="card my-3">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['klantnaam']; ?></h5>
            <p class="card-text text-muted"><?php echo $row['klantemail']; ?></p>
            <a type="button" class="btn btn-primary btn-rounded" data-mdb-modal-init data-mdb-target="#klant<?php echo $row['klantID']; ?>" href="#">
            More info
            </a>
            <div class="dropdown manage-user" style="position: absolute; top: 10px; right: 10px;">
              <button class="dropdown-toggle btn btn-primary btn-floating" style="width: 28px; height: 28px;" type="button" data-mdb-dropdown-init aria-expanded="false"></button>
              <ul class="dropdown-menu">
                <li><a type="button" class="d-inline-block dropdown-item" data-mdb-modal-init data-mdb-target="#edit<?php echo $row['klantID']; ?>" href="#">Edit</a></li>
                <li><?php include 'deleteuser.php'; ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal more info -->
      <div class="modal fade" id="klant<?php echo $row['klantID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $row['klantnaam']; ?></h5>
              <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <p class="card-text"><b>Email:</b><br> <?php echo $row['klantemail']; ?></p>
                </div>
                <div class="col-6">
                  <p class="card-text"><b>Geboortedatum:</b><br> <?php echo $row['geboortedatum']; ?></p>
                </div>
                <div class="col-6">
                  <p class="card-text"><b>Passwoord:</b><br> <?php echo $row['passwoord']; ?></p>
                </div>
                <div class="col-6">
                  <p class="card-text"><b>Rol:</b><br> <?php echo $row['rol']; ?></p>
                </div>
                <div class="col-6">
                  <p class="card-text"><b>Registratiedatum:</b><br> <?php echo $row['registratiedatum']; ?></p>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="edit<?php echo $row['klantID']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit user: <?php echo $row['klantnaam'] ?></h5>
              <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form name="edituser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row g-3">

                <div class="col-md-6">
                  <label for="nameUpdate" class="form-label">Name:</label>
                  <input type="text" name="nameUpdate" id="nameUpdate" class="form-control" value="<?php echo $row['klantnaam'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid name.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="passwordUpdate" class="form-label">Password:</label>
                  <input type="text`" name="passwordUpdate" id="passwordUpdate" class="form-control" value="<?php echo $row['passwoord'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid password.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="emailUpdate" class="form-label">Email:</label>
                  <input type="email" name="emailUpdate" id="emailUpdate" class="form-control" value="<?php echo $row['klantemail'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid email address.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="rolUpdate" class="form-label">Role:</label>
                  <input type="text" name="rolUpdate" id="rolUpdate" class="form-control" value="<?php echo $row['rol'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid role.
                  </div>
                </div>
                
                <div class="col-md-6">
                  <label for="birthUpdate" class="form-label">Date of birth:</label>
                  <input type="date" name="birthUpdate" id="birthUpdate" class="form-control" value="<?php echo $row['geboortedatum'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid date of birth.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="Update_registratiedatum" class="form-label">Registration date:</label>
                  <input type="date" name="registrationUpdate" id="registrationUpdate" class="form-control" value="<?php echo $row['registratiedatum'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid registration date.
                  </div>
                </div>
                <input type="hidden" name="klantID" value="<?php echo $row['klantID'] ?>">
                <input type="submit" value="Update user" class="btn btn-primary" name="btnUpdate">
              </form>
              <?php include 'updateuser.php'; ?>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    echo '</div>';
  }
  else {
    ?>
    <div style="display: flex; flex-direction: column; align-items: center;">
      <h1 style="display: inline-block;">No users found</h1>
      <img src="assets/img/notfound.png" alt="notfound.png" style="display: block;" class="mt-5" width="300px">
    </div>
    <?php
  }

  $stmt->close();
  $mysql->close();

?>