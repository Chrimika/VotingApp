<?php
  if(isset($_SESSION['admin'])){ // Only allow admins to increment votes
    $id = $_GET['id'];
    $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = '$id'";
    $conn->query($sql);
    header('Location: result.php');
  } else {
    header('Location: index.php');
  }
?>