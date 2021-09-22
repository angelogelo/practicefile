<?php
	
	include 'connection.php';
	
	$client_id = mysqli_real_escape_string($connection, $_POST['client_id']);
	$membership_id = mysqli_real_escape_string($connection, $_POST['membership_id']);
	$price = mysqli_real_escape_string($connection, $_POST['price']);
	$registration_date = mysqli_real_escape_string($connection, $_POST['registration_date']);
	$start_date = mysqli_real_escape_string($connection, $_POST['start_date']);
	$end_date = mysqli_real_escape_string($connection, $_POST['end_date']);
	$remarks = mysqli_real_escape_string($connection, $_POST['remarks']);
	$coach_id = mysqli_real_escape_string($connection, $_POST['coach_id']);

	$select = $connection->query("SELECT * FROM subscriptions WHERE client_id = '$client_id'");

	if ($select->num_rows < 1) {

		// $insert = $connection->query("INSERT INTO subscriptions (client_id, coach_id, membership_id, membership_cost, registration_date, start_date, end_date, remark, created_at) VALUES ('$client_id', '$coach_id', '$membership_id', '$price', '$registration_date', '$start_date', '$end_date', '$remarks', '$timeNow')");

		// if ($insert === TRUE) {
		// 	echo "Added";
		// }else{
		// 	echo "Failed";
		// }
		
	}else{
		echo "Taken";
	}

	


?>