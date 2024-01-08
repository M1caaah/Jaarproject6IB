<?php
/** 
 * Handles adding and updating customers in the database.
 * Prints success or error messages based on query results.
 */
if (isset($_POST['btnToevoegen'])) {
  $new_klantnaam = $_POST['new_klantnaam'];
  $new_klantemail = $_POST['new_klantemail'];
  $new_geboortedatum = $_POST['new_geboortedatum'];
  $new_passwoord = $_POST['new_passwoord'];
  $new_rol = $_POST['new_rol'];
  $new_registratiedatum = $_POST['new_registratiedatum'];
  
  $insertSql = "INSERT INTO tblklant (Klantnaam, Klantemail, Geboortedatum, Passwoord, Rol, Registratiedatum) VALUES (?, ?, ?, ?, ?, ?)";
  
  if ($stmt = $mysqli->prepare($insertSql)) {
    $stmt->bind_param("ssssss", $new_klantnaam, $new_klantemail, $new_geboortedatum, $new_passwoord, $new_rol, $new_registratiedatum);
    
    if (!$stmt->execute()) {
      echo 'Het toevoegen van de klant is mislukt: ' . $stmt->error;
    }
    
    $stmt->close();
  } else {
    echo 'Er zit een fout in de query: ' . $mysqli->error;
  }
}
?>