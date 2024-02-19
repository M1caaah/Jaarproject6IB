<?php
require_once '../connection.php';
/**
 * @var string $server
 * @var string $user
 * @var string $password
 * @var string $database
 **/

$mysqli = new MySQLi($server, $user, $password, $database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $currentUrl = $_SERVER['REQUEST_URI'];
    $currentUrl = str_replace('products/handleproducts.php', 'products.php', $currentUrl);
    header( "Location: $currentUrl");
    exit;
}
$data = array_keys($_POST);
$id = null;
foreach ($data as $key) {
    if (strpos($key, 'ID-') !== false) {
        $id = substr($key, 3);
    }
}

$action = $_POST["ID-$id"];

if ($action === 'Delete')
{
    $sql = "UPDATE tblartikel SET active = 0 WHERE artikelID = $id";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->close();
    unset($_POST);
    header('Location: ../products.php');
}
else if ($action === 'Edit')
{
    $sql = "SELECT * FROM tblartikel WHERE artikelID = $id";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $id = $result['artikelID'];
    $name = $result['artikelNaam'];
    $price = $result['artikelPrijs'];
    $stock = $result['artikelVoorraad'];
    $minage = $result['active'];

    include 'editproduct.php';
}
else if ($action === 'Update')
{
    $name = $_POST['nameUpdate'];
    $price = $_POST['priceUpdate'];
    $stock = $_POST['stockUpdate'];
    $minage = $_POST['minAgeUpdate'];

    $sql = "UPDATE tblartikel SET artikelNaam = ?, artikelPrijs = ?, artikelVoorraad = ? WHERE artikelID = ? AND active = 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sdii', $name, $price, $stock, $id);
    $stmt->execute();
    $stmt->close();
    unset($_POST);
    header('Location: ../products.php');
}

$mysqli->close();