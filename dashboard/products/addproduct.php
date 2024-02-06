<?php

include 'connection.php';

$mysqli = new MySQLi($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$success = false;

if (isset($_POST['nameNew'])) {

    $target_dir = "../assets/images/productimages";

    if (isset($_FILES["imageNew"])) {

        // Check if file already exists
        $target_file = $target_dir . '/' . basename($_FILES["imageNew"]["name"]);
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        $new_productimage = $_FILES["imageNew"]["name"];
    }


    $new_productname = htmlspecialchars($_POST['productNameNew']);
    $new_productamount = htmlspecialchars($_POST['productStockNew']);
    $new_productprice = htmlspecialchars($_POST['productPriceNew']);
    $new_productMinAge = htmlspecialchars($_POST['productMinAge']);

    // Email is unique, proceed with the insertion
    $insertSql = "INSERT INTO tblartikel (artikelNaam, artikelVoorraad, artikelPrijs, artikelAfbeelding, artikelMinLeeftijd) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($insertSql);
    $stmt->bind_param("ssssss", $new_productname, $new_productamount, $new_productprice, $new_productimage, $new_productMinAge);

    if ($stmt->execute()) {
        $success = true;
    }

    $stmt->close();

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
