<?php
$mysqli = new MySQLi("localhost", "root", "", "jaarproject");
/**
 * Handles deleting selected customers from the database.
 * Builds a DELETE query to delete the customers with the given IDs. 
 * Uses prepare() and bind_param() to sanitize the input.
 * Executes the query and prints a message based on success or failure.
 */
if (isset($_POST['btnwissen'])) {
    if (isset($_POST['klantids']) && is_array($_POST['klantids'])) {
        $deleteSql = "DELETE FROM tblklant WHERE KlantID IN (" . implode(',', $_POST['klantids']) . ")";

        if ($stmt = $mysqli->prepare($deleteSql)) {
            if ($stmt->execute()) {
                echo count($_POST['klantids']) . " klant(en) verwijderd!";
            } else {
                echo 'Het verwijderen van de geselecteerde klanten is mislukt: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Er zit een fout in de delete-query: ' . $mysqli->error;
        }
    } else {
        echo 'Geen klanten geselecteerd om te verwijderen.';
    }
}

/**
 * Connects to the database, prepares and executes a SELECT query to get customer data, 
 * outputs the data in an HTML table, and provides edit and delete options.
 */
if (mysqli_connect_errno()) {
    trigger_error('Fout bij verbinding: ' . $mysqli->error);
} else {
    $sql = "SELECT * FROM tblklant";
    if (isset($_GET['search_klantnaam']) && !empty($_GET['search_klantnaam'])) {
        $sql .= " WHERE klantnaam LIKE ?";
    }
    
    if ($stmt = $mysqli->prepare($sql)) {
        if (isset($_GET['search_klantnaam']) && !empty($_GET['search_klantnaam'])) {
            $searchTerm = '%' . $_GET['search_klantnaam'] . '%';
            $stmt->bind_param("s", $searchTerm);
        }
        
        if (!$stmt->execute()) {
            echo 'Het uitvoeren van de query is mislukt: ' . $stmt->error . ' in query:' . $sql;
        } else {
            $stmt->bind_result($KlantID, $Klantnaam, $Klantemail, $Geboortedatum, $Passwoord, $Rol, $Registratiedatum);
            echo '<br><br><form name="form1" method="post" action="' . $_SERVER['PHP_SELF'] . '?actie=wis">';
                echo '<table border="1"><tr><th> Select </th><th> KlantID </th><th>Klantnaam</th><th> Klantemail </th><th>Geboortedatum</th><th>Passwoord</th><th>Rol</th><th>Registratiedatum</th><th> Edit </th></tr>';
                
                while ($stmt->fetch()) {
                    $teverwijderen = $KlantID;
                    echo '<tr>';
                        echo '<td><input type="checkbox" name="klantids[]" value="' . $teverwijderen . '"></td>';
                        echo '<td>' . $teverwijderen . "</td><td> " . $Klantnaam . "</td><td>" . $Klantemail . "</td><td>" . $Geboortedatum . '</td>';
                        echo '<td>' . $Passwoord . '</td><td>' . $Rol . '</td><td>' . $Registratiedatum . '</td>';
                        
                        echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?actie=edit&klantid=' . $teverwijderen . '">Edit</a></td>';
                
                        echo '</tr>';
                    }
                    
                    echo '</table>';
                    echo '<input type="submit" name="btnwissen" id="wis" value="Wis geselecteerde items">';
                    echo '</form>';
                }
                
                $stmt->close();
            } else {
                echo 'Er zit een fout in de query: ' . $mysqli->error;
    }
}
?>


<form action="addcustomer.php">
    <button type="submit">Voeg item toe</button>
</form>