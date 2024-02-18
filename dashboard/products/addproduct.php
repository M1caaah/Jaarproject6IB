<?php

include 'connection.php';

/** @var string $server */
/** @var string $user */
/** @var string $password */
/** @var string $database */
$mysqli = new MySQLi($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$success = false;

if (isset($_POST['btnAddProduct'])) {

    $target_dir = 'assets/img/productimages';

    $new_productname = htmlspecialchars($_POST['nameNew']);
    $new_productamount = max(0, intval(htmlspecialchars($_POST['stockNew'])));
    $new_productprice = htmlspecialchars($_POST['priceNew']);
    $new_productMinAge = max(0, intval(htmlspecialchars($_POST['minAgeNew'])));
    $new_productimage = '';

    if (isset($_FILES["imageNew"])) {

        // Check if file already exists
        $target_file = $target_dir . '/' . basename($_FILES["imageNew"]["name"]);
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        move_uploaded_file($_FILES["imageNew"]["tmp_name"], $target_file);
        $new_productimage = basename($_FILES["imageNew"]["name"]);
    }




    // Email is unique, proceed with the insertion
    $insertSql = "INSERT INTO tblartikel (artikelNaam, artikelVoorraad, artikelPrijs, artikelAfbeelding, artikelMinLeeftijd) VALUES (?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($insertSql);
    $stmt->bind_param("sssss", $new_productname, $new_productamount, $new_productprice, $new_productimage, $new_productMinAge);

    if ($stmt->execute()) {
        $success = true;
    }

    $stmt->close();

}?>

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
