<script>
  function refresh(){
    location.reload();
  }
</script>

<?php
if (isset($_POST['btnUpdate']) && $_POST['klantID'] == $row['klantID']) {
  
  $update_klantnaam = htmlspecialchars($_POST['nameUpdate']);
  $update_klantemail = htmlspecialchars($_POST['emailUpdate']);
  $update_geboortedatum = htmlspecialchars($_POST['birthUpdate']);
  if (strtotime($update_geboortedatum) > strtotime(date('Y-m-d'))) {
    // Todo add error message and fix the date problem.
    
    exit; 
  }
  $update_passwoord = htmlspecialchars($_POST['passwordUpdate']);
  $update_rol = htmlspecialchars($_POST['rolUpdate']);
  $update_registratiedatum = htmlspecialchars($_POST['registrationUpdate']);
  $update_id = htmlspecialchars($row['klantID']);

  $insertSql = "UPDATE tblklant SET klantnaam = ?, klantemail = ?, geboortedatum = ?, passwoord = ?, rol = ?, registratiedatum = ? WHERE klantID = ?";

  $stmtUpdate = $mysql->prepare($insertSql);
  $stmtUpdate->bind_param("sssssss", $update_klantnaam, $update_klantemail, $update_geboortedatum, $update_passwoord, $update_rol, $update_registratiedatum, $update_id);
  $stmtUpdate->execute();
  $stmtUpdate->close();

  $_POST = array();
  echo '<script>refresh();</script>';
  //This is very much bruteforcing the problem of not making it regenerating on refresh. 
  //But this works. So I won't touch it for now.
  if ($success) {
    echo '<script>
         if (window.history.replaceState) {
             window.history.replaceState(null, null, window.location.href);
         }
         </script>';
}
}
?>
