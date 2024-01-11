<?php
$mysqli = new MySQLi("localhost", "root", "", "jaarproject");
$mysqli->set_charset("utf8mb4");

if (isset($_GET['actie']) && $_GET['actie'] === 'edit' && isset($_GET['klantid'])) {
    $klantid = $_GET['klantid'];

    $selectSql = "SELECT * FROM tblklant WHERE KlantID = ?";
    if ($stmt = $mysqli->prepare($selectSql)) {
        $stmt->bind_param("i", $klantid);

        if ($stmt->execute()) {
            $stmt->bind_result($KlantID, $Klantnaam, $Klantemail, $Geboortedatum, $Passwoord, $Rol, $Registratiedatum);

            if ($stmt->fetch()) {
?>
                <form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Edit klant:</h2>
                    <input type="hidden" name="edit_klantid" value="<?php echo $KlantID; ?>">

                    <label for="new_klantnaam">Klantnaam:</label>
                    <input type="text" name="edit_klantnaam" id="new_klantnaam" value="<?php echo $Klantnaam; ?>" required><br>

                    <label for="new_klantemail">Klantemail:</label>
                    <input type="email" name="edit_klantemail" id="new_klantemail" value="<?php echo $Klantemail; ?>" required><br>

                    <label for="new_geboortedatum">Geboortedatum:</label>
                    <input type="date" name="edit_geboortedatum" id="new_geboortedatum" value="<?php echo $Geboortedatum; ?>" required><br>

                    <label for="new_passwoord">Passwoord:</label>
                    <input type="text" name="edit_passwoord" id="new_passwoord" value="<?php echo $Passwoord; ?>" required><br>

                    <label for="new_rol">Rol:</label>
                    <input type="text" name="edit_rol" id="new_rol" value="<?php echo $Rol; ?>" required><br>

                    <label for="new_registratiedatum">Registratiedatum:</label>
                    <input type="date" name="edit_registratiedatum" id="new_registratiedatum" value="<?php echo $Registratiedatum; ?>" required><br>

                    <input type="submit" name="btnUpdate" id="update" value="Update">
                </form>
<?php
            } else {
                echo 'Klant not found.';
            }
        } else {
            echo 'Error fetching customer details: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo 'Error in SELECT query: ' . $mysqli->error;
    }
}
?>
