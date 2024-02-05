<?php

include 'connection.php';

$mysqli = new MySQLi($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$success = false;

if (isset($_POST['nameNew'])) {
    $new_klantnaam = htmlspecialchars($_POST['nameNew']);
    $new_klantemail = htmlspecialchars($_POST['emailNew']);
    $new_geboortedatum = htmlspecialchars($_POST['birthNew']);
    $new_passwoord = htmlspecialchars($_POST['passwordNew']);
    $new_rol = htmlspecialchars($_POST['roleNew']);
    $new_registratiedatum = htmlspecialchars($_POST['registrationNew']);

    // Check if the email is already in use
    $checkEmailSql = "SELECT * FROM tblklant WHERE Klantemail = ?";
    $checkEmailStmt = $mysqli->prepare($checkEmailSql);
    $checkEmailStmt->bind_param("s", $new_klantemail);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        // Email already in use, handle accordingly (show error message, etc.)
        echo "Error: Email already in use";
    } else {
        // Email is unique, proceed with the insertion
        $insertSql = "INSERT INTO tblklant (Klantnaam, Klantemail, Geboortedatum, Passwoord, Rol, Registratiedatum) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($insertSql);
        $stmt->bind_param("ssssss", $new_klantnaam, $new_klantemail, $new_geboortedatum, $new_passwoord, $new_rol, $new_registratiedatum);

        if ($stmt->execute()) {
            $success = true;
        }

        $stmt->close();
    }

    $checkEmailStmt->close();
}
?>

<?php
//This is very much bruteforcing the problem of not making it regenerating on refresh. 
//But this works. So I won't touch it for now.
if ($success) {
    echo '<script>
           if (window.history.replaceState) {
               window.history.replaceState(null, null, window.location.href);
           }
           </script>';
}
?>
