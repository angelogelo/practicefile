<?php

	include'connection.php';

	$picture_tmp = $_FILES['picture']['tmp_name'];
	$picture_name = $_FILES['picture']['name'];
	$picture = time()."_".$picture_name;

	$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($connection, $_POST['middlename']);
	$lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
	$birthDate = mysqli_real_escape_string($connection, $_POST['birthDate']);
	$contact_no = mysqli_real_escape_string($connection, $_POST['contact_no']);
	$address = mysqli_real_escape_string($connection, $_POST['address']);
	$height = mysqli_real_escape_string($connection, $_POST['height']);
	$weight = mysqli_real_escape_string($connection, $_POST['weight']);
	$password = password_hash(strtolower($contactNumber), PASSWORD_DEFAULT);

	$totalHeight = $height/100*$height/100;
	$totalBMI = $weight/$totalHeight;

	$finalTotal = number_format($totalBMI, 2);

	$client_id = mt_rand();

	$type = "client";

	$select_contact_no = $connection->query("SELECT * FROM client WHERE contact_no = '$contact_no'");

	if ($select_contact_no->num_rows < 1) {
		
		if ($picture_tmp !== "") {

			if (move_uploaded_file($picture_tmp, '../images/client/'.$picture)) {

				$insert = $connection->query("INSERT INTO client (picture, client_id, firstname, middlename, lastname, gender, birthDate, height, weight, bmi, address, contact_no, created_at) VALUES ('$picture','$client_id','$firstname','$middlename','$lastname','$gender','$birthDate','$height','$weight','$finalTotal','$address','$contact_no','$timeNow')");

				if ($insert === TRUE) {

					$insertUser = $connection->query("INSERT INTO user (identification, username, password, picture, type, contact_no, created_at) VALUES ('$client_id','$client_id','$password','$picture','$type','$contact_no','$timeNow')");
					
					echo "Inserted";

				}else{

					echo "Insert Failed";
				}

			}else{
				echo "Image Failed";
			}
			
		}else{

			$insert = $connection->query("INSERT INTO client (client_id, firstname, middlename, lastname, gender, birthDate, height, weight, bmi, address, contact_no, created_at) VALUES ('$client_id','$firstname','$middlename','$lastname','$gender','$birthDate','$height','$weight','$finalTotal','$address','$contact_no','$timeNow')");

			if ($insert === TRUE) {

				$insertUser = $connection->query("INSERT INTO user (identification, username, password, type, contact_no, created_at) VALUES ('$client_id','$client_id','$password','$type','$contact_no','$timeNow')");
				
				echo "InserteD";

			}else{
				echo "Insert Failed";
			}
		}

	}else{
		echo "Contact Taken";
	}
?>