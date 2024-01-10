<form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Edit klant:</h2>
    <label for="new_klantnaam">Klantnaam:</label>
    <input type="text" name="new_klantnaam" id="new_klantnaam" required><br>

    <label for="new_klantemail">Klantemail:</label>
    <input type="email" name="new_klantemail" id="new_klantemail" required><br>

    <label for="new_geboortedatum">Geboortedatum:</label>
    <input type="date" name="new_geboortedatum" id="new_geboortedatum" required><br>

    <label for="new_passwoord">Passwoord:</label>
    <input type="password" name="new_passwoord" id="new_passwoord" required><br>

    <label for="new_rol">Rol:</label>
    <input type="text" name="new_rol" id="new_rol" required><br>

    <label for="new_registratiedatum">Registratiedatum:</label>
    <?php $today = new DateTime();
    $dateString = $today->format('Y-m-d');
    ?>
    <input type="date" name="new_registratiedatum" id="new_registratiedatum" value="<?php echo $dateString;?>" required><br>

    <input type="submit" name="btnToevoegen" id="toevoegen" value="Voeg toe">
</form>

<?php
$mysqli = new MySQLi("localhost", "root", "", "jaarproject");
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