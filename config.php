<?php
	$conn = new mysqli("localhost","root","","login_sample_db");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>