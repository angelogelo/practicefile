<?php
	
	header('Content-Type: application/json');
	include 'connection.php';

	$response = array();

	if (isset($_GET['membership_id'])) {
		
		$select = "SELECT * FROM membership_plans WHERE id = '".$_GET['membership_id']."'";
		$result = mysqli_query($connection, $select);

		while ($row = mysqli_fetch_array($result)) {
			array_push($response, $row);
		}
		echo json_encode($response);
	}


?>