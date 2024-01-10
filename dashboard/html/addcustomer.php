<script>
  function check(){
    var check = true;

    if(document.getElementById("nameNew").value == "")
    {
      document.getElementById("nameCheck").innerHTML = "Please write a name."
      check = false;
    }else{
      document.getElementById("nameCheck").innerHTML = "";
    }
  }
</script>

<form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Voeg nieuwe klant toe:</h2>
    <label for="nameNew">Klantnaam:</label>
    <label id="nameCheck"></label> 
    <input type="text" name="nameNew" id="nameNew" required><br>

    <label for="emailNew">Klantemail:</label>
    <label id="emailCheck"></label> 
    <input type="email" name="emailNew" id="emailNew" required><br>

    <label for="birthNew">Geboortedatum:</label>
    <label id="birthCheck"></label> 
    <input type="date" name="birthNew" id="birthNew" required><br>

    <label for="passwordNew">Passwoord:</label>
    <label id="passwordCheck"></label>
    <input type="password" name="passwordNew" id="passwordNew" required><br>

    <label for="rolNew">Rol:</label>
    <label id="rolCheck"></label>
    <input type="text" name="rolNew" id="rolNew" required><br>

    <label for="new_registratiedatum">Registratiedatum:</label>
    <?php $today = new DateTime();
    $dateString = $today->format('Y-m-d');
    ?>
    <label id="registrationNew"></label>
    <input type="date" name="registrationNew" id="registrationNew" value="<?php echo $dateString;?>" required><br>

    <input type="submit" name="btnAdd" id="add" value="Voeg toe">
</form>


<?php
/** 
 * Handles adding and updating customers in the database.
 * Prints success or error messages based on query results.
 */

$mysqli = new MySQLi("localhost", "root", "", "jaarproject");
if (isset($_POST['btnToevoegen'])) {
  $new_klantnaam = $_POST['nameNew'];
  $new_klantemail = $_POST['emailNew'];
  $new_geboortedatum = $_POST['birthNew'];
  $new_passwoord = $_POST['passwordNew'];
  $new_rol = $_POST['rolNew'];
  $new_registratiedatum = $_POST['registrationNew'];
  
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