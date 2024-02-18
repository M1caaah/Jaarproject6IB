<script>
	function validateForm() {
		let check = true;
		let nameUpdate = document.getElementById("nameUpdate");
		let nameCheck = document.getElementById("nameCheck");
		let lastnameUpdate = document.getElementById("lastnameUpdate");
		let lastnameCheck = document.getElementById("lastnameCheck");
		let emailUpdate = document.getElementById("emailUpdate");
		let emailCheck = document.getElementById("emailCheck");
		let birthUpdate = document.getElementById("birthUpdate");
		let birthCheck = document.getElementById("birthCheck");
		let passwordUpdate = document.getElementById("passwordUpdate");
		let passwordCheck = document.getElementById("passwordCheck");
		let roleUpdate = document.getElementById("roleUpdate");
		let roleCheck = document.getElementById("rolCheck");


		if (nameUpdate.value === "") {
			check = false;
			nameCheck.innerText = "Please write a name.";
		} else {

		}

		if (lastnameUpdate.value === "") {
			check = false;
			lastnameCheck.innerText = "Please write a last name.";
		} else {

		}

		if (emailUpdate.value === "" || !isValidEmail(emailUpdate.value)) {
			check = false;
			emailCheck.innerText = "Please write a valid email.";
		} else {

		}

		let birthDate = new Date(birthUpdate.value);
		let today = new Date();
		if (birthUpdate.value === "") {
			check = false;
			birthCheck.innerText = "Please write a date of birth.";
		} else if (birthDate > today) {
			// Check if birth date is later than today
			check = false;
			birthCheck.innerText = "Birth date cannot be later than today.";
		}

		let registrationDate = new Date(registrationUpdate.value);
		if (registrationUpdate.value === "") {
			check = false;
			registrationUpdate.innerText = "Please write a date of birth.";
		} else if (registrationDate < birthDate) {
			check = false;
			registrationCheck.innerText = "Registration date cannot be earlier than birth date.";
		}

		if (passwordUpdate.value === "") {
			check = false;
			passwordCheck.innerText = "Please write a password.";
		} else {

		}

		if (roleUpdate.value === "") {
			check = false
			roleCheck.innerHTML = "Please write a role.";
		} else {

		}	

		if (check) {
		console.log(forms[id]);
		 forms[id].submit();
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

<?php
include 'connection.php';

$mysql = new MySQLi($server, $user, $password, $database);

if ($mysql->connect_error) {
	die("Connection failed: " . $mysql->connect_error);
}

if (isset($_GET['search'])) {

    // Prepare the search statement.
    $searchTerm = $_GET['search'];
    $searchTerm = mysqli_real_escape_string($mysql, $searchTerm);
    $searchTerm = htmlspecialchars($searchTerm);
    $searchTerm = trim($searchTerm);
    $searchTerm = "%" . $searchTerm . "%";

    // Prepare the SQL statement.
	
	if ($_GET['rdbSearch'] == "name") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantnaam` LIKE ? AND `active` = 1";
	} else if ($_GET['rdbSearch'] == "lastname") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantachternaam` LIKE ? AND `active` = 1";
	} else if ($_GET['rdbSearch'] == "email") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantemail` LIKE ? AND `active` = 1";
	} else {
		$sql = "SELECT * FROM `tblklant` WHERE `rol` LIKE ? AND `active` = 1";
	}

    // Apply sorting if specified
    if(isset($_GET['sortBy'])) {
        switch($_GET['sortBy']) {
            case 'name_asc':
                $sql .= " ORDER BY `klantnaam` ASC";
                break;
            case 'name_desc':
                $sql .= " ORDER BY `klantnaam` DESC";
                break;
            case 'lastname_asc':
                $sql .= " ORDER BY `klantachternaam` ASC";
                break;
            case 'lastname_desc':
                $sql .= " ORDER BY `klantachternaam` DESC";
                break;
            default:
                break;
        }
    }

    // Prepare the statement.
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param('s', $searchTerm);
} else {

    // Prepare the SQL statement.
    $sql = "SELECT * FROM `tblklant` WHERE `active` = 1";

    if(isset($_GET['sortBy'])) {
        switch($_GET['sortBy']) {
            case 'name_asc':
                $sql .= " ORDER BY `klantnaam` ASC";
                break;
            case 'name_desc':
                $sql .= " ORDER BY `klantnaam` DESC";
                break;
            case 'lastname_asc':
                $sql .= " ORDER BY `klantachternaam` ASC";
                break;
            case 'lastname_desc':
                $sql .= " ORDER BY `klantachternaam` DESC";
                break;
            default:
                break;
        }
    }

    // Prepare the statement.
    $stmt = $mysql->prepare($sql);
}
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
	echo '<div class="row">';
	while ($row = $result->fetch_assoc()) {
?>
		<div class="col-md-4 col-sm-6 col-12">
			<div class="card my-3">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['klantnaam'] . ' ' . $row['klantachternaam']; ?></h5>
					<p class="card-text text-muted"><?php echo $row['klantemail']; ?></p>
					<a type="button" class="btn btn-primary btn-rounded" data-mdb-modal-init data-mdb-target="#klant<?php echo $row['klantID']; ?>" href="#">
						More info
					</a>
					<form action="users/handleusers.php" method="post">
                        <div class="dropdown manage-user" style="position: absolute; top: 10px; right: 10px;">
                            <button class="dropdown-toggle btn btn-primary btn-floating" style="width: 28px; height: 28px;" type="button" data-mdb-dropdown-init aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                                <li><input type="submit" name="ID-<?php echo $row['klantID']; ?>" value="Edit"></li>
                                <li><input type="submit" name="ID-<?php echo $row['klantID']; ?>" value="Delete"></li>
                            </ul>
                        </div>
                    </form>
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
							<div class="col-6">
								<p class="card-text"><b>Achternaam:</b><br> <?php echo $row['klantachternaam']; ?></p>
							</div>
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