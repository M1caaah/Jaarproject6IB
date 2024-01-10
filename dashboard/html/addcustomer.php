<form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Voeg nieuwe klant toe:</h2>
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
/** 
 * Handles adding and updating customers in the database.
 * Prints success or error messages based on query results.
 */

$mysqli = new MySQLi("localhost", "root", "", "jaarproject");
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
    else{
      echo 'Het toevoegen van de klant is gelukt!';
    }

    $stmt->close();
  } else {
    echo 'Er zit een fout in de query: ' . $mysqli->error;
  }
}
?>