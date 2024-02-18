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
			document.forms.editUser.submit();
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

	// Prepare the SQL statement.
	if ($_GET['rdbSearch'] == "name") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantnaam` LIKE ? AND `active` = 1";
	} else if ($_GET['rdbSearch'] == "last name") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantachternaam` LIKE ? AND `active` = 1";
	} else if ($_GET['rdbSearch'] == "email") {
		$sql = "SELECT * FROM `tblklant` WHERE `klantemail` LIKE ? AND `active` = 1";
	} else {
		$sql = "SELECT * FROM `tblklant` WHERE `rol` LIKE ? AND `active` = 1";
	}
	// Prepare the statement.
	$stmt = $mysql->prepare($sql);
	$stmt->bind_param('s', $searchTerm);
} else {

	// Prepare the SQL statement.
	$sql = "SELECT * FROM `tblklant` WHERE `active` = 1";

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

		<!-- Modal -->
		<div class="modal fade" id="edit<?php echo $row['klantID']; ?>" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit user: <?php echo $row['klantnaam'] ?></h5>
						<button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form name="editUser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row g-3">

							<div class="col-md-6">
								<label for="nameUpdate" class="form-label">Name:</label>
								<input type="text" name="nameUpdate" id="nameUpdate" class="form-control" value="<?php echo $row['klantnaam'] ?>">
								<label name="nameCheck" id="nameCheck" value="">
							</div>

							<div class="col-md-6">
								<label for="lastnameUpdate" class="form-label">Last name:</label>
								<input type="text" name="lastnameUpdate" id="lastnameUpdate" class="form-control" value="<?php echo $row['klantachternaam']; ?>">
								<label name="lastnameNewCheck" id="lastnameNewCheck" value="">
							</div>


							<div class="col-md-6">
								<label for="passwordUpdate" class="form-label">Password:</label>
								<input type="text`" name="passwordUpdate" id="passwordUpdate" class="form-control" value="<?php echo $row['passwoord'] ?>">
								<label name="passwordCheck" id="passwordCheck" value=""></label>
							</div>

							<div class="col-md-6">
								<label for="emailUpdate" class="form-label">Email:</label>
								<input type="text" name="emailUpdate" id="emailUpdate" class="form-control" value="<?php echo $row['klantemail'] ?>">
								<label name="emailCheck" id="emailCheck" value="">

							</div>

							<div class="col-md-6">
								<label for="roleUpdate" class="form-label">Role:</label>
								<input type="text" name="roleUpdate" id="roleUpdate" class="form-control" value="<?php echo $row['rol'] ?>">
								<label name="rolCheck" id="rolCheck" value="">
							</div>

							<div class="col-md-6">
								<label for="birthUpdate" class="form-label">Date of birth:</label>
								<input type="date" name="birthUpdate" id="birthUpdate" class="form-control" value="<?php echo $row['geboortedatum'] ?>">
								<label name="birthCheck" id="birthCheck" value="">
							</div>

							<div class="col-md-6">
								<label for="Update_registratiedatum" class="form-label">Registration date:</label>
								<input type="date" name="registrationUpdate" id="registrationUpdate" class="form-control" value="<?php echo $row['registratiedatum'] ?>">
								<label name="registrationCheck" id="registrationCheck" value="">
							</div>
							<input type="hidden" name="klantID" value="<?php echo $row['klantID'] ?>">
							<input type="button" value="Update user" class="btn btn-primary" name="btnUpdate" onclick="validateForm()">
						</form>
						<?php include 'updateuser.php'; ?>
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