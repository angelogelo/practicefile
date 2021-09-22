<?php  

	include'connection.php';

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$select = $connection->query("SELECT * FROM user WHERE username='$username'");
	if ($select->num_rows < 1) {
		echo "No Account";
	}else {
		$selectRow = $select->fetch_array();
		$passwordCheck = $selectRow['password'];

		$type = $selectRow['type'];

		if (password_verify($password, $passwordCheck)) {
			if ($type == "coach") {
				$_SESSION['coach'] = $username;

				$coach = $connection->query("SELECT * FROM coach WHERE coach_id='$username'");
				$coachRow = $coach->fetch_array();

				if ($coachRow['status'] == "pending" OR $coachRow['status'] == "deactivated") {
					echo "Pending";
					exit();
				}

			}else if ($type == "client") {
				$_SESSION['client'] = $username;

				$client = $connection->query("SELECT * FROM client WHERE client_id='$username'");
				$clientRow = $client->fetch_array();

				if ($clientRow['status'] == "deactivated") {
					echo "Deactivated";
					exit();
				}

			}else {
				$_SESSION['admin'] = $username;
			}

			echo $type;

		}else {
			echo "No Account";
		}
	}

?>