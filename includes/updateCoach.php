<?php  
	
	include'connection.php';

	$picture_tmp = $_FILES['picture']['tmp_name'];
	$picture_name = $_FILES['picture']['name'];
	$picture = time()."_".$picture_name;

	$update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
	$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($connection, $_POST['middlename']);
	$lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
	$birthDate = mysqli_real_escape_string($connection, $_POST['birthDate']);
	$contactNumber = mysqli_real_escape_string($connection, $_POST['contactNumber']);
	$address = mysqli_real_escape_string($connection, $_POST['address']);
	$coach_skills = mysqli_real_escape_string($connection, $_POST['coach_skills']);

	if ($picture_tmp !== "") {
		if (move_uploaded_file($picture_tmp, '../images/coach/'.$picture)) {
			$update = $connection->query("UPDATE coach SET picture='$picture', coach_skills_id='$coach_skills', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact_no='$contactNumber', gender='$gender', dateofbirth='$birthDate', address='$address' WHERE id='$update_id'");
			if ($update === TRUE) {
				echo "Updated";
			}else{
				echo "Failed";
			}
		}else{
			echo "Failed";
		}
	}else{
		$update = $connection->query("UPDATE coach SET coach_skills_id='$coach_skills', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact_no='$contactNumber', gender='$gender', dateofbirth='$birthDate', address='$address' WHERE id='$update_id'");
		if ($update === TRUE) {
			echo "Updated";
		}else{
			echo "Failed";
		}
	}


?>