<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <button class="dropdown-item" name="btnDelete" type="submit">Delete</button>
    <input type="hidden" name="artikelID" value="<?php echo $row['artikelID']; ?>">
</form>


<?php
if (isset($_POST['btnDelete']) && $_POST['artikelID'] == $row['artikelID']) {
    $id = $_POST['artikelID'];

    $sql = "UPDATE tblartikel SET active = 0 WHERE artikelID =?";

    $stmtDelete = $mysql->prepare($sql);
    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();
    $stmtDelete->close();
    $_POST = array();
}

?>