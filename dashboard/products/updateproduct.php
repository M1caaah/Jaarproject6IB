<?php
if (isset($_POST['btnUpdateProduct']) && (int)$_POST['productID'] === $row['artikelID']) {

    $update_productid = htmlspecialchars($_POST['productID']);
    $update_productname = htmlspecialchars($_POST['nameEdit']);
    $update_productamount = max(0, intval(htmlspecialchars($_POST['stockEdit'])));
    $update_productprice = htmlspecialchars($_POST['priceEdit']);
//    $update_productimage = htmlspecialchars($_POST['']);
    $update_productMinAge = max(0, intval(htmlspecialchars($_POST['minAgeEdit'])));

    $insertSql = "UPDATE tblartikel SET artikelID = ?, artikelNaam = ?, artikelVoorraad = ?, artikelPrijs = ?, artikelMinLeeftijd = ? WHERE artikelID = ?";

    $stmtUpdate = $mysql->prepare($insertSql);
    $stmtUpdate->bind_param("ssssss", $update_productid, $update_productname, $update_productamount, $update_productprice, $update_productMinAge, $update_productid);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $_POST = array();

    echo '<script> if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href) } </script>';
}

?>