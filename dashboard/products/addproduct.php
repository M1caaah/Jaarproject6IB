<?php

include 'connection.php';

$mysqli = new MySQLi($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$success = false;

if (isset($_POST['nameNew'])) {
    $new_productname = htmlspecialchars($_POST['productNameNew']);
    $new_productamount = htmlspecialchars($_POST['productStockNew']);
    $new_productprice = htmlspecialchars($_POST['productPriceNew']);
    $new_productimage = htmlspecialchars($_POST['productImageNew']);
    $new_productMinAge = htmlspecialchars($_POST['productMinAge']);

    // Check if the email is already in use
    $checkEmailSql = "SELECT * FROM tblartikel WHERE artikelNaam = ?";
    $checkEmailStmt = $mysqli->prepare($checkEmailSql); //Micah link pls thank you i love you mwah.
    $checkEmailStmt->bind_param("s", $new_productname);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result(); //Micah link pls thank you i love you mwah.

    if ($checkEmailResult->num_rows > 0) {
        // Email already in use, handle accordingly (show error message, etc.)
        echo "Error: Email already in use";
    } else {
        // Email is unique, proceed with the insertion
        $insertSql = "INSERT INTO tblartikel (artikelNaam, artikelVoorraad, artikelPrijs, artikelAfbeelding, artikelMinLeeftijd) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($insertSql);
        $stmt->bind_param("ssssss", $new_productname, $new_productamount, $new_productprice, $new_productimage, $new_productMinAge);

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
