<?php
include 'connection.php';

$mysql = new MySQLi($server, $user, $password, $database);

//This is a interesting way fix the charset problem. I should change it in the database. But it works for now.
$mysql->set_charset("utf8mb4");

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

if (isset($_GET['search'])) {

    // Prepare the search statement statement.
    $searchTerm = $_GET['search'];
    $searchTerm = mysqli_real_escape_string($mysql, $searchTerm);
    $searchTerm = htmlspecialchars($searchTerm);
    $searchTerm = trim($searchTerm);
    $searchTerm = strtolower($searchTerm);
    $searchTerm = "%" . $searchTerm . "%";

    // Prepare the statement.
    $sql = "SELECT * FROM `tblartikel` WHERE `artikelNaam` LIKE ? AND `active` = 1";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('s', $searchTerm);
} else {

    // Prepare the SQL statement.
    $sql = "SELECT * FROM `tblartikel` WHERE `active` = 1";

    // Prepare the statement.
    $stmt = $mysql->prepare($sql);
}
$stmt->execute();

$result = $stmt->get_result();

//Hey micaaaaaaaaaa, if you do this bbg, i will give you Rayan's private maid dress image collection
if ($result->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-md-4 col-sm-6 col-12" style="width: auto">
            <div class="card my-3" style="width: 200px;">
                <div class="bg-image hover-overlay">
                    <img src="<?php echo IMGSOURCE.$row['artikelAfbeelding'] ?>" class="img-fluid" alt="<?php echo $row['artikelAfbeelding'] ?>" style="width: 200px; height: 200px;"/>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['artikelNaam']; ?></h5>
                    <p>&euro;<?php echo sprintf("%.2f", $row['artikelPrijs']) ?></p>
                    <a type="button" class="btn btn-primary btn-rounded" data-mdb-modal-init data-mdb-target="#klant<?php echo $row['artikelID']; ?>" href="#">
                        More info
                    </a>
                    <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                        <button class="dropdown-toggle btn btn-primary btn-floating" style="width: 28px; height: 28px;" type="button" data-mdb-dropdown-init aria-expanded="false"></button>
                        <ul class="dropdown-menu shadow-3-strong">
                            <li>
                                <a type="button" class="d-inline-block dropdown-item" data-mdb-modal-init data-mdb-target="#edit<?php echo $row['artikelID']; ?>" href="#">Edit</a>
                            </li>
                            <li><?php include 'deleteproduct.php'; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- More info -->
        <div class="modal fade" id="klant<?php echo $row['artikelID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $row['artikelNaam']; ?></h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text"><b>Name:</b><br> <?php echo $row['artikelNaam']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text"><b>Product ID:</b><br> <?php echo $row['artikelID']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text"><b>Price:</b><br> &euro;<?php echo $row['artikelPrijs']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text"><b>Stock:</b><br> <?php echo $row['artikelVoorraad']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text"><b>Minimum age:</b><br> <?php echo $row['artikelMinLeeftijd']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit -->
        <div class="modal fade" id="edit<?php echo $row['artikelID']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit product: <?php echo $row['artikelNaam'] ?></h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="editProduct" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row g-3">

                            <div class="col-md-6">
                                <label for="nameEdit" class="form-label">Name:</label>
                                <input required type="text" name="nameEdit" id="nameEdit" class="form-control" value="<?php echo $row['artikelNaam'] ?>">
                                <label id="nameCheck"></label>
                            </div>

                            <div class="col-md-6">
                                <label for="priceEdit" class="form-label">Price:</label>
                                <input required type="number" step="0.01" name="priceEdit" id="priceEdit" class="form-control" value="<?php echo $row['artikelPrijs'] ?>">
                                <label id="priceCheck"></label>
                            </div>

                            <div class="col-md-6">
                                <label for="stockEdit" class="form-label">Stock:</label>
                                <input required type="number" step="1" name="stockEdit" id="stockEdit" class="form-control" value="<?php echo $row['artikelVoorraad'] ?>">
                                <label id="stockCheck"></label>
                            </div>

                            <div class="col-md-6">
                                <label for="minAgeEdit" class="form-label">Minimum age:</label>
                                <input required type="number" step="1" name="minAgeEdit" id="minAgeEdit" class="form-control" value="<?php echo $row['artikelMinLeeftijd'] ?>">
                                <label id="minAgeCheck"></label>
                            </div>

                            <input type="hidden" name="productID" value="<?php echo $row['artikelID'] ?>">
                            <input type="submit" value="Update product" class="btn btn-primary" name="btnUpdateProduct">
                        </form>
                        <?php include 'products/updateproduct.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
} else {
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