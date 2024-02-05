<?php
if (isset($_POST['nameUpdate']) && $_POST['artikelID'] == $row['artikelID']) { //Change this accordingly micah
    $update_productid = htmlspecialchars($_POST['productNameUpdate']);
    $update_productname = htmlspecialchars($_POST['productNameUpdate']);
    $update_productamount = htmlspecialchars($_POST['productAmountUpdate']);
    $update_productprice = htmlspecialchars($_POST['productPriceUpdate']);
    $update_productimage = htmlspecialchars($_POST['productImageUpdate']);
    $update_productMinAge = htmlspecialchars($_POST['productMinAgeUpdate']);

    $insertSql = "UPDATE tblartikel SET artikelID = ?, artikelNaam = ?, artikelVoorraad = ?, artikelPrijs = ?, artikelAfbeelding = ?, artikelMinLeeftijd = ? WHERE artikelID = ?";

    $stmtUpdate = $mysql->prepare($insertSql);
    $stmtUpdate->bind_param("sssssss", $update_productid, $update_productname, $update_productamount, $update_productprice, $update_productimage, $update_productMinAge, $update_productid);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $_POST = array();
}
?>