<?php
require_once '../connection.php';
/**
 * @var string $server
 * @var string $user
 * @var string $password
 * @var string $database
**/

$mysqli = new MySQLi($server, $user, $password, $database);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $currentUrl = $_SERVER['REQUEST_URI'];
    $currentUrl = str_replace('users/handleusers.php', '', $currentUrl);
    header( "Location: $currentUrl");
    exit;
}
$data = array_keys($_POST);
$id = null;
foreach ($data as $key) {
    if (str_contains($key, 'ID-')) {
        $id = substr($key, 3);
    }
}


$action = $_POST["ID-$id"];

if($action === 'Delete') {
    $sql = "DELETE FROM tblklant WHERE klantID = $id";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->close();
}
else if($action === 'Edit') {
    $sql = "SELECT * FROM tblklant WHERE klantID = $id";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $sql = "SELECT * FROM tblrol";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $roles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $id = $result['klantID'];
    $firstname = $result['klantnaam'];
    $lastname = $result['klantachternaam'];
    $email = $result['klantemail'];
    $bdate = $result['geboortedatum'];
    $currentRole = $result['rol_id'];
    $regdate = $result['registratiedatum'];

    include 'edituser.php';
}
else if($action === 'Update') {
    $sql = "UPDATE tblklant SET klantnaam = ?, klantachternaam = ?, klantemail = ?, geboortedatum = ?, rol_id = ?, registratiedatum = ?, passwoord = ? WHERE klantID = ? AND active = 1";
    $stmt = $mysqli->prepare($sql);
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['nameUpdate']);
    $lastname = htmlspecialchars($_POST['lastnameUpdate']);
    $email = htmlspecialchars($_POST['emailUpdate']);
    $birth = htmlspecialchars($_POST['birthUpdate']);
    $role = $_POST['roleUpdate'];
    $registration = htmlspecialchars($_POST['registrationUpdate']);
    $password = password_hash($_POST['passwordUpdate'], PASSWORD_DEFAULT);
    $stmt->bind_param("ssssissi", $name, $lastname, $email, $birth, $role, $registration, $password, $id);
    $stmt->execute();
    $stmt->close();

    unset($_POST);
    header('Location: ../index.php');
}


$mysqli->close();