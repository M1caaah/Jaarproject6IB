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

<script>
	function validateNewForm(formType) {

		let check = true;

		let nameNew = document.getElementById("nameNew");
		let nameNewCheck = document.getElementById("nameNewCheck");
		let lastnameNew = document.getElementById("lastnameNew");
		let lastnameNewCheck = document.getElementById("lastnameNewCheck");
		let emailNew = document.getElementById("emailNew");
		let emailNewCheck = document.getElementById("emailNewCheck");
		let birthNew = document.getElementById("birthNew");
		let birthNewCheck = document.getElementById("birthNewCheck");
		let passwordNew = document.getElementById("passwordNew");
		let passwordNewCheck = document.getElementById("passwordNewCheck");
		let roleNew = document.getElementById("roleNew");
		let roleNewCheck = document.getElementById("roleNewCheck");


		if (nameNew.value === "") {
			check = false;
			nameNewCheck.innerText = "Please write a name.";
		} else {

		}

		if (lastnameNew.value === "") {
			check = false;
			nameNewCheck.innerText = "Please write a last name.";
		} else {

		}

		if (emailNew.value === "" || !isValidEmail(emailNew.value)) {
			check = false;
			emailNewCheck.innerText = "Please write a valid email.";
		} else {

		}

		let birthDate = new Date(birthNew.value);
		let today = new Date();
		if (birthNew.value === "") {
			check = false;
			birthNewCheck.innerText = "Please write a date of birth.";
		} else if (birthDate > today) {
			// Check if birth date is later than today
			check = false;
			birthNewCheck.innerText = "Birth date cannot be later than today.";
		}

		if (passwordNew.value === "") {
			check = false;
			passwordNewCheck.innerText = "Please write a password.";
		} else {

		}

		if (roleNew.value === "") {
			check = false
			roleNewCheck.innerHTML = "Please write a role.";
		} else {

		}

		if (check) {
			document.forms.addUser.submit();
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

<body>

	<!--Main Navigation-->
	<header>
		<!-- Sidebar -->
		<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
			<div class="position-sticky">
				<div class="list-group list-group mx-3 mt-4">
					<a href="index.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
						<i class="fas fa-user-gear fa-fw me-3"></i>
						<span>Users</span>
					</a>
                    <a href="products.php" class="list-group-item list-group-item-action py-2 ripple">
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
					<form action="index.php" method="get">
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
                            <div class="input-group">
                                <select class="form-select" name="sortBy" aria-label="Sort By">
                                    <option value="name_asc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'name_asc') echo 'selected'; ?>>First Name (A-Z)</option>
                                    <option value="name_desc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'name_desc') echo 'selected'; ?>>First Name (Z-A)</option>
                                    <option value="lastname_asc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'price_asc') echo 'selected'; ?>>Last Name (A-Z)</option>
                                    <option value="lastname_desc" <?php if(isset($_GET['sortBy']) && $_GET['sortBy'] == 'price_desc') echo 'selected'; ?>>Last Name (Z-A)</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sort"></i> Sort
                                    </button>
                            </div>
						</div>
						<br>
						<span class="me-3">Search by: </span>
    						<div class="form-check form-check-inline">
        						<input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio1" value="name" <?php if (isset($_GET['rdbSearch']) && $_GET['rdbSearch'] == "name") { echo "checked"; } elseif (!isset($_GET['rdbSearch'])) { echo "checked"; } ?>>
        						<label class="form-check-label" for="inlineRadio1">Name</label>
    						</div>
    						<div class="form-check form-check-inline">
        						<input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio2" value="lastname" <?php if (isset($_GET['rdbSearch']) && $_GET['rdbSearch'] == "lastname") { echo "checked"; } ?>>
        						<label class="form-check-label" for="inlineRadio2">Last Name</label>
    						</div>
    						<div class="form-check form-check-inline">
        						<input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio3" value="email" <?php if (isset($_GET['rdbSearch']) && $_GET['rdbSearch'] == "email") { echo "checked"; } ?>>
        						<label class="form-check-label" for="inlineRadio3">Email</label>
    						</div>
    						<div class="form-check form-check-inline">
        						<input class="form-check-input" type="radio" name="rdbSearch" id="inlineRadio4" value="role" <?php if (isset($_GET['rdbSearch']) && $_GET['rdbSearch'] == "role") { echo "checked"; } ?>>
        						<label class="form-check-label" for="inlineRadio4">Role</label>
    					</div>
					</form>
					<br>
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
									<form name="addUser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="row g-3">

										<div class="col-md-6">
											<label for="nameNew" class="form-label">Name:</label>
											<input type="text" name="nameNew" id="nameNew" class="form-control" value="">
											<label name="nameNewCheck" id="nameNewCheck" value="">
										</div>

										<div class="col-md-6">
											<label for="lastnameNew" class="form-label">Last name:</label>
											<input type="text" name="lastnameNew" id="lastnameNew" class="form-control" value="">
											<label name="lastnameNewCheck" id="lastnameNewCheck" value="">
										</div>

										<div class="col-md-6">
											<label for="passwordNew" class="form-label">Password:</label>
											<input type="text`" name="passwordNew" id="passwordNew" class="form-control" value="">
											<label name="passwordNewCheck" id="passwordNewCheck" value=""></label>
										</div>

										<div class="col-md-6">
											<label for="emailNew" class="form-label">Email:</label>
											<input type="text" name="emailNew" id="emailNew" class="form-control" value="">
											<label name="emailNewCheck" id="emailNewCheck" value="">

										</div>

										<div class="col-md-6">
											<label for="roleNew" class="form-label">Role:</label>
											<input type="text" name="roleNew" id="roleNew" class="form-control" value="">
											<label name="roleNewCheck" id="roleNewCheck" value="">
										</div>

										<div class="col-md-6">
											<label for="birthNew" class="form-label">Date of birth:</label>
											<input type="date" name="birthNew" id="birthNew" class="form-control" value="">
											<label name="birthNewCheck" id="birthNewCheck" value="">
										</div>

										<div class="col-md-6">
											<label for="new_registratiedatum" class="form-label">Registration date:</label>
											<?php $today = new DateTime();
											$dateString = $today->format('Y-m-d');
											?>
											<input type="date" name="registrationNew" id="registrationNew" class="form-control" value="<?php echo $dateString ?>">
										</div>
										<input type="button" value="Add user" class="btn btn-primary" name="btnAdd" onclick="validateNewForm()">
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php include 'users/adduser.php' ?>
				</div>
			</div>
			<div class="container my-3">
				<?php include 'users/searchresult.php' ?>
			</div>
		</div>
		</div>
	</main>

	<!-- MDB -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>