<?php
if (isset($_POST['nameUpdate']) && $_POST['klantID'] == $row['klantID']) {

	$update_klantnaam = htmlspecialchars($_POST['nameUpdate']);
	$update_klantachternaam = htmlspecialchars($_POST['lastnameUpdate']);
	$update_klantemail = htmlspecialchars($_POST['emailUpdate']);
	$update_geboortedatum = htmlspecialchars($_POST['birthUpdate']);
	$update_passwoord = htmlspecialchars($_POST['passwordUpdate']);
	$update_rol = htmlspecialchars($_POST['roleUpdate']);
	$update_registratiedatum = htmlspecialchars($_POST['registrationUpdate']);
	$update_id = htmlspecialchars($row['klantID']);

	$insertSql = "UPDATE tblklant SET klantnaam = ?, klantachternaam, klantemail = ?, geboortedatum = ?, passwoord = ?, rol = ?, registratiedatum = ? WHERE klantID = ?";

	$stmtUpdate = $mysql->prepare($insertSql);
	$stmtUpdate->bind_param("ssssssss", $update_klantnaam, $update_klantemail, $update_geboortedatum, $update_passwoord, $update_rol, $update_registratiedatum, $update_id);
	$stmtUpdate->execute();
	$stmtUpdate->close();

	$_POST = array();
}
?>