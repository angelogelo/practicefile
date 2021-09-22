<?php

	// $ip = "192.168.100.6";
	// $phone = "09959325871";
	// $message = "Hello!";
	
	function($ip, $phone, $message){

		$send = json_decode(file_get_contents("http://192.168.100.2:8080?phone=09959325871&message=Hello"));
		return $send->status == 200 ? true : false;
	}

	send("192.168.100.2", "09959325871", "Hello");

?>