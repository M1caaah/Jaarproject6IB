<script>
  // function check() {
  //   alert("checking");
  //   let check = true;

  //   let nameValue = document.getElementById("nameNew").value;
  //   if (nameValue == "") {
  //     document.getElementById("nameCheck").innerHTML = "Please write a name.";
  //     check = false;
  //   } else {
  //     document.getElementById("nameCheck").innerHTML = "";
  //   }

  //   let emailValue = document.getElementById("emailNew").value;
  //   if (emailValue == "" || !isValidEmail(emailValue)) {
  //     document.getElementById("emailCheck").innerHTML = "Please enter a valid email.";
  //     check = false;
  //   } else {
  //     document.getElementById("emailCheck").innerHTML = "";
  //   }

  //   let birthValue = document.getElementById("birthNew").value;
  //   if (birthValue == "") {
  //     document.getElementById("birthCheck").innerHTML = "Please enter a valid birth date.";
  //     check = false;
  //   } else {
  //     document.getElementById("birthCheck").innerHTML = "";
  //   }

  //   let passwordValue = document.getElementById("passwordNew").value;
  //   if (passwordValue == "") {
  //     document.getElementById("passwordCheck").innerHTML = "Please enter a password.";
  //     check = false;
  //   } else {
  //     document.getElementById("passwordCheck").innerHTML = "";
  //   }

  //   let roleValue = document.getElementById("rolNew").value;
  //   if (roleValue == "") {
  //     document.getElementById("rolCheck").innerHTML = "Please enter a role.";
  //     check = false;
  //   } else {
  //     document.getElementById("rolCheck").innerHTML = "";
  //   }

  //   if (check) {
      
  //   }
  // }

  // function isValidEmail(email) {
  //   // Simple email validation, will be improved later.
  //   let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  //   return emailRegex.test(email);
  // }
</script>


<?php

  include 'connection.php';

  $mysqli = new MySQLi($server, $user, $password, $database);

  if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
  }
  


  if (isset($_POST['btnAdd'])) {
    $new_klantnaam = htmlspecialchars($_POST['nameNew']);
    $new_klantemail = htmlspecialchars($_POST['emailNew']);
    $new_geboortedatum = htmlspecialchars($_POST['birthNew']);
    $new_passwoord = htmlspecialchars($_POST['passwordNew']);
    $new_rol = htmlspecialchars($_POST['rolNew']);
    $new_registratiedatum = htmlspecialchars($_POST['registrationNew']);

    $insertSql = "INSERT INTO tblklant (Klantnaam, Klantemail, Geboortedatum, Passwoord, Rol, Registratiedatum) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($insertSql);
    $stmt->bind_param("ssssss", $new_klantnaam, $new_klantemail, $new_geboortedatum, $new_passwoord, $new_rol, $new_registratiedatum);
    $stmt->execute();
    $stmt->close();

    $_POST = array();


  }

  $mysqli->close();

?>