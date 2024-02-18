<?php
/**
 * @var string $id
 * @var string $firstname
 * @var string $lastname
 * @var string $email
 * @var string $bdate
 * @var string $currentRole
 * @var string $regdate
 * @var array $roles
 */
?>


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
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<body>

<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group mx-3 mt-4">
                <a href="../index.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                    <i class="fas fa-user-gear fa-fw me-3"></i>
                    <span>Users</span>
                </a>
                <a href="../products.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-bag-shopping fa-fw me-3"></i>
                    <span>Products</span>
                </a>
                <a href="../coming-soon.php" class="list-group-item list-group-item-action py-2 ripple">
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
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/img/logos/logo.png" height="35" alt="" loading="lazy" />
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
<main style="margin-top: 58px">
    <div class="container w-50 pt-5">
        <h1>Edit user</h1>
        <form name="editUser" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="row g-3 editForm">
            <div class="col-md-6">
                <label for="nameUpdate" class="form-label">Name:</label>
                <input type="text" name="nameUpdate" id="nameUpdate" class="form-control" value="<?php echo $firstname ?>">
                <label id="nameCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="lastnameUpdate" class="form-label">Last name:</label>
                <input type="text" name="lastnameUpdate" id="lastnameUpdate" class="form-control" value="<?php echo $lastname ?>">
                <label id="lastnameCheck"></label>
            </div>


            <div class="col-md-6">
                <label for="passwordUpdate" class="form-label">Password:</label>
                <input type="password" name="passwordUpdate" id="passwordUpdate" class="form-control">
                <label id="passwordCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="emailUpdate" class="form-label">Email:</label>
                <input type="text" name="emailUpdate" id="emailUpdate" class="form-control" value="<?php echo $email ?>">
                <label id="emailCheck"></label>

            </div>

            <div class="col-md-6">
                <label for="roleUpdate" class="form-label">Role:</label>
                <select name="roleUpdate" id="roleUpdate" class="form-control">
                    <?php foreach ($roles as $role) {
                        if ($role['rol_id'] === $currentRole) {
                            echo "<option value='{$role['rol_id']}' selected>{$role['rolnaam']}</option>";
                        } else {
                            echo "<option value='{$role['rol_id']}'>{$role['rolnaam']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="birthUpdate" class="form-label">Date of birth:</label>
                <input type="date" name="birthUpdate" id="birthUpdate" class="form-control" value="<?php echo $bdate ?>">
                <label id="birthCheck"></label>
            </div>

            <div class="col-md-6">
                <label for="Update_registratiedatum" class="form-label">Registration date:</label>
                <input type="date" name="registrationUpdate" id="registrationUpdate" class="form-control" value="<?php echo $regdate ?>">
                <label id="registrationCheck"></label>
            </div>
            <input type="hidden" id="id" name="ID-<?php echo $id?>" value="Update">
            <input type="button" value="Update user" class="btn btn-primary" name="btnUpdate" onclick="validateForm()">
        </form>
    </div>
</main>

</body>
</html>
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

        console.log(lastnameCheck)
        if (nameUpdate.value === "") {
            check = false;
            console.log(nameCheck)
            nameCheck.innerText = "Please write a name.";
        } else {
            nameCheck.innerText = "";
        }

        if (lastnameUpdate.value === "") {
            check = false;
            lastnameCheck.innerText = "Please write a last name.";
        } else {
            lastnameCheck.innerText = "";
        }

        if (emailUpdate.value === "" || !isValidEmail(emailUpdate.value)) {
            check = false;
            emailCheck.innerText = "Please write a valid email.";
        } else {
            emailCheck.innerText = "";
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
        } else {
            birthCheck.innerText = "";
        }

        let registrationDate = new Date(registrationUpdate.value);
        if (registrationUpdate.value === "") {
            check = false;
            registrationUpdate.innerText = "Please write a date of birth.";
        } else if (registrationDate < birthDate) {
            check = false;
            registrationCheck.innerText = "Registration date cannot be earlier than birth date.";
        } else {
            registrationCheck.innerText = "";
        }

        if (roleUpdate.value === "") {
            check = false
            roleCheck.innerHTML = "Please write a role.";
        } else {

        }
        if (check) {
            document.editUser.submit();
        }
    }

    function isValidEmail(email) {
        // Use a regular expression to validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        return email && emailRegex.test(email);
    }
</script>


