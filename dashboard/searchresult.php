<?php

  include 'connection.php';

  $conn = new MySQLi($server,$user,$password,$database);
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
  

  $conn->close();

?>