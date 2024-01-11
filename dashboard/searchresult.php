<?php

  include 'connection.php';

  $conn = new MySQLi($server,$user,$password,$database);
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  if (isset($_GET['search'])) {
    
    //This is a interesting way fix the charset problem. I should change it in the database. But it works for now.
    $conn->set_charset("utf8mb4");

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
          <a type="button" class="btn btn-primary btn-rounded" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#klant<?php echo $row['klantID']; ?>" href="#">
          More info
          </a>
        </div>
      </div>
    </div>

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














        <?php
      }
      echo '</div>';
    }

    $stmt->close();
  }
  

  $conn->close();

?>