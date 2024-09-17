<?php
include 'includes/session.php';
include 'includes/connection.php';

if(isset($_SESSION['admin'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM votes WHERE candidate_id = '$id'";
  $query = $conn->query($sql);
  $num_rows = $query->num_rows;
  if($num_rows > 0){
    $new_votes = $num_rows - 1;
    $sql = "UPDATE candidates SET votes = '$new_votes' WHERE id = '$id'";
    $conn->query($sql);
  }

  header('location: result.php');
} else {
  header('location: index.php');
}
?>