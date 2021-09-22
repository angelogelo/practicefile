<?php

	include'connection.php';

	$height = mysqli_real_escape_string($connection, $_POST['height']);
	$weight = mysqli_real_escape_string($connection, $_POST['weight']);
	$client_id = mysqli_real_escape_string($connection, $_POST['client_id']);
	$created_at = mysqli_real_escape_string($connection, $_POST['created_at']);

	$totalHeight = $height/100*$height/100;
	$totalBMI = $weight/$totalHeight;

	$finalTotal = number_format($totalBMI, 2);

	$insert = $connection->query("INSERT INTO client_bmi (client_id, height, weight, bmi, created_at) VALUES ('$client_id', '$height', '$weight', '$finalTotal', '$created_at')");

	if ($insert === TRUE) {
		echo "Added";
	}else{
		echo "Failed";
	}

?>