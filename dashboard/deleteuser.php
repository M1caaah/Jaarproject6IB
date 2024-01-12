<form action="<?php  echo $_SERVER['PHP_SELF'] ?>" method="post">
  <button class="dropdown-item" name="btnDelete" type="submit">Delete</button>
  <input type="hidden" name="klantID" value="<?php echo $row['klantID'];?>">
</form>


<?php
  if (isset($_POST['btnDelete'])){
    echo "<script>alert('posted');</script>";
  }


  if (isset($_POST['btnDelete']) && $_POST['klantID'] == $row['klantID']) {
    echo "<script>alert('deleted');</script>";
    $id = $_POST['klantID'];
    
    $sql = "DELETE FROM tblklant WHERE klantID =?";

    $stmtDelete = $conn->prepare($sql);
    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();
    $stmtDelete->close();

    $_POST = array();

  }

?>