<?php
	ob_start();
	session_start();
	$timezone=date_default_timezone_set("America/New_York");


	$hostname="localhost";
	$user="root";
	$pass="";
	$db="slotify";

	$con=mysqli_connect($hostname,$user,$pass,$db);

	if (!$con) {
		echo "Failed to connect to databse ".mysqli_connect_errno();
	}


?>