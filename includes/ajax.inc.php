<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

// Är användaren inloggad?
if (login_check($mysqli) == true) :

	// Vilken action har AJAX förfrågan
	if($_POST['action'] == 'checkinout') :

		//Lägg till koll om användaren har rättigheter att checka in gäster?

		// Get userid & status (strip tags and whitespace)
		$uid = strip_tags( trim( $_POST['userId'] ) );
		$status = strip_tags( trim( $_POST['status'] ) );

		// Save checkin to database table 'guest', row matching checkin_uid & list_id
		$sql = "UPDATE `guests` SET status ='" . $status . "' WHERE id='" . $uid . "'"; 
		$mysqli2->query($sql) or die( mysqli_connect_errno() ); 

		// return success
		echo 'checkedin';
	endif;
else :
	echo 'Fuskar du?';
endif;
?>