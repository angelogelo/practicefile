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

	if ($picture_tmp !== "") {
		if (move_uploaded_file($picture_tmp, '../images/client/'.$picture)) {
			$update = $connection->query("UPDATE client SET picture='$picture', firstname='$firstname', middlename='$middlename', lastname='$lastname', gender='$gender', dateofbirth='$birthDate', address='$address', contact_no='$contactNumber' WHERE id='$update_id'");
			if ($update === TRUE) {
				echo "Updated";
			}else{
				echo "Failed";
			}
		}else{
			echo "Failed";
		}
	}else{
		$update = $connection->query("UPDATE client SET firstname='$firstname', middlename='$middlename', lastname='$lastname', gender='$gender', dateofbirth='$birthDate', address='$address', contact_no='$contactNumber' WHERE id='$update_id'");
		if ($update === TRUE) {
			echo "Updated";
		}else{
			echo "Failed";
		}
	}


?>