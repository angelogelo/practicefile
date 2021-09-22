<?php
	
	include 'connection.php';
	
	$coach_skills = mysqli_real_escape_string($connection, $_POST['coach_skills']);

	$selectSkills = $connection->query("SELECT * FROM skills WHERE skills_name = '$coach_skills'");

	if ($selectSkills->num_rows < 1) {
		
		$insert = $connection->query("INSERT INTO skills (skills_name, created_at) VALUES ('$coach_skills', '$timeNow')");

		echo "Insert";

	}else{
		echo "Taken";
	}

?>