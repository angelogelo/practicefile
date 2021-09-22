<?php

  include'connection.php';

  $update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
  $membership_name = mysqli_real_escape_string($connection, $_POST['membership_name']);
  $price = mysqli_real_escape_string($connection, $_POST['price']);
  $duration = mysqli_real_escape_string($connection, $_POST['duration']);
  $details = mysqli_real_escape_string($connection, $_POST['details']);

  if ($membership_name !== "") {
      $update = $connection->query("UPDATE membership_plans SET membership_name = '$membership_name', price = '$price', duration = '$duration', details = '$details' WHERE id = '$update_id'");

      if ($update === TRUE) {
        echo "Updated";
      }else{
        echo "Failed";
      }

  }else{
    echo "Nothing to Update";
  }

?>