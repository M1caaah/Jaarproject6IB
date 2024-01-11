<?php

  include 'connection.php';

  $conn = new MySQLi($server,$user,$password,$database);
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  //This is a interesting way fix the charset problem. I should change it in the database. But it works for now.
  $conn->set_charset("utf8mb4");


  if (isset($_GET['search'])) {
    
    // Prepare the search statement statement.
    $searchTerm = $_GET['search'];
    $searchTerm = mysqli_real_escape_string($conn,$searchTerm);
    $searchTerm = htmlspecialchars($searchTerm);
    $searchTerm = trim($searchTerm);
    $searchTerm = strtolower($searchTerm);
    $searchTerm = "%".$searchTerm."%";

    // Prepare the SQL statement.
    $sql = "SELECT * FROM `tblklant` WHERE `klantnaam` LIKE ?";
    // Prepare the statement.
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$searchTerm);
  }
  else {
    
    // Prepare the SQL statement.
    $sql = "SELECT * FROM `tblklant`";

    // Prepare the statement.
    $stmt = $conn->prepare($sql);

  }

  
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo '<div class="row">';
    while($row = $result->fetch_assoc()) {
      ?>
      <div class="col-4">
        <div class="card my-3">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['klantnaam']; ?></h5>
            <p class="card-text text-muted"><?php echo $row['klantemail']; ?></p>
            <a type="button" class="d-inline-block btn btn-primary btn-rounded" data-mdb-modal-init data-mdb-target="#klant<?php echo $row['klantID']; ?>" href="#">
            More info
            </a>
            <div class="d-inline-block dropdown">
              <button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-mdb-dropdown-init aria-expanded="false">
                Manage user
              </button>
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
                  <label for="nameNew" class="form-label">Name:</label>
                  <input type="text" name="nameNew" id="nameNew" class="form-control" value="<?php echo $row['klantnaam'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid name.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="passwordNew" class="form-label">Password:</label>
                  <input type="password" name="passwordNew" id="passwordNew" class="form-control" value="<?php echo $row['passwoord'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid password.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="emailNew" class="form-label">Email:</label>
                  <input type="email" name="emailNew" id="emailNew" class="form-control" value="<?php echo $row['klantemail'] ?>" required>
                  <div class="invalid-feedback">
                    Vul een geldig e-mailadres.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="rolNew" class="form-label">Role:</label>
                  <input type="text" name="rolNew" id="rolNew" class="form-control" value="<?php echo $row['rol'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid role.
                  </div>
                </div>
                
                <div class="col-md-6">
                  <label for="birthNew" class="form-label">Date of birth:</label>
                  <input type="date" name="birthNew" id="birthNew" class="form-control" value="<?php echo $row['geboortedatum'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid date of birth.
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="new_registratiedatum" class="form-label">Registration date:</label>
                  <?php $today = new DateTime();
                  $dateString = $today->format('Y-m-d');
                  ?>
                  <input type="date" name="registrationNew" id="registrationNew" class="form-control" value="<?php echo $row['registratiedatum'] ?>" required>
                  <div class="invalid-feedback">
                    Enter a valid registration date.
                  </div>
                </div>
                <input type="submit" value="Update user" class="btn btn-primary" name="btnAdd">
              </form>
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
  $conn->close();

?>