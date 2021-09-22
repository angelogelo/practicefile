<?php
	
	include 'connection.php';
	
	$membership_name = mysqli_real_escape_string($connection, $_POST['membership_name']);
	$price = mysqli_real_escape_string($connection, $_POST['price']);
	$duration = mysqli_real_escape_string($connection, $_POST['duration']);
	$details = mysqli_real_escape_string($connection, $_POST['details']);

	$selectMembership = $connection->query("SELECT * FROM membership_plans WHERE duration = '$duration'");

	if ($selectMembership->num_rows < 1) {
		
		$insert = $connection->query("INSERT INTO membership_plans (membership_name, price, duration, details, created_at) VALUES ('$membership_name', '$price', '$duration', '$details', '$timeNow')");

		echo "Insert";

	}else{
		echo "Taken";
	}

?>