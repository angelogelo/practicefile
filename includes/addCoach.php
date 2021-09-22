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
	$coach_skills = mysqli_real_escape_string($connection, $_POST['coach_skills']);
	$password = password_hash(strtolower($contact_no), PASSWORD_DEFAULT);

	$coach_id = mt_rand();

	$type = "coach";

	$select_contact_no = $connection->query("SELECT * FROM coach WHERE contact_no = '$contact_no'");

	if ($select_contact_no->num_rows < 1) {
		
		if ($picture_tmp !== "") {

			if (move_uploaded_file($picture_tmp, '../images/coach/'.$picture)) {

				$insert = $connection->query("INSERT INTO coach (picture, coach_id, coach_skills_id, firstname, middlename, lastname, contact_no, gender, birthDate, address, created_at) VALUES ('$picture','$coach_id','$coach_skills','$firstname','$middlename','$lastname','$contact_no','$gender','$birthDate','$address','$timeNow')");

				if ($insert === TRUE) {

					$insertUser = $connection->query("INSERT INTO user (identification, username, password, picture, type, contact_no, created_at) VALUES ('$coach_id','$coach_id','$password','$picture','$type','$contact_no','$timeNow')");
					
					echo "Inserted";

				}else{

					echo "Insert Failed";
				}

			}else{
				echo "Image Failed";
			}
			
		}else{

			$insert = $connection->query("INSERT INTO coach (coach_id, coach_skills_id, firstname, middlename, lastname, contact_no, gender, birthDate, address, created_at) VALUES ($coach_id','$coach_skills','$firstname','$middlename','$lastname','$contact_no','$gender','$birthDate','$address','$timeNow')");

			if ($insert === TRUE) {

				$insertUser = $connection->query("INSERT INTO user (identification, username, password, type, contact_no, created_at) VALUES ('$coach_id','$coach_id','$password','$type','$contact_no','$timeNow')");
				
				echo "InserteD";

			}else{
				echo "Insert Failed";
			}
		}

	}else{
		echo "Contact Taken";
	}
?>