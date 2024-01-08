<?php
/**
* Updates an existing customer in the database.
* Prints success/error messages.
*/
if (isset($_POST['btnUpdate'])) {
	$edit_klantid = $_POST['edit_klantid'];
	$edit_klantemail = $_POST['edit_klantemail'];
	$edit_geboortedatum = $_POST['edit_geboortedatum'];
	$edit_passwoord = $_POST['edit_passwoord'];
	$edit_rol = $_POST['edit_rol'];
	$edit_registratiedatum = $_POST['edit_registratiedatum'];
	$edit_klantnaam = $_POST['edit_klantnaam'];
	
	$updateSql = "UPDATE tblklant SET Klantnaam = ?, Klantemail = ?, Geboortedatum = ?, Passwoord = ?, Rol = ?, Registratiedatum = ? WHERE KlantID = ?";
	if ($stmt = $mysqli->prepare($updateSql)) {
		$stmt->bind_param("ssssssi", $edit_klantnaam, $edit_klantemail, $edit_geboortedatum, $edit_passwoord, $edit_rol, $edit_registratiedatum, $edit_klantid);
		
		if ($stmt->execute()) {
		} else {
			echo 'Het updaten van de klant is mislukt: ' . $stmt->error;
		}
		
		$stmt->close();
	} else {
		echo 'Er zit een fout in de update-query: ' . $mysqli->error;
	}
}
?>