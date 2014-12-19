<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

// Är användaren inloggad?
if (login_check($mysqli) == true) :

	// Check In/Out
	if($_POST['action'] == 'checkinout') :

		//Lägg till koll om användaren har rättigheter att checka in gäster?

		// Get userid & status (strip tags and whitespace)
		$uid = strip_tags( trim( $_POST['userId'] ) );
		$status = strip_tags( trim( $_POST['status'] ) );

		// Save checkin to database table 'guest', row matching userID
		$sql = "UPDATE `guests` SET status = '" . $status . "' WHERE id='" . $uid . "'"; 
		$mysqli2->query($sql) or die( mysqli_connect_errno() ); 

		// return success
		echo 'checkedin';
	endif;

	// Form Activate/Deactivate
	if($_POST['action'] == 'formactive') :

		// Get form ID & Active
		$form_id = strip_tags( trim( $_POST['formId'] ) );
		$active = strip_tags( trim( $_POST['active'] ) );

		// Save active value to database table 'forms', row matching form_id
		$sql = "UPDATE `forms` SET active = '" . $active . "' WHERE id='" . $form_id . "'";
		$mysqli2->query($sql) or die( mysqli_connect_errno() );

		echo $active;
	endif;
else :
	echo 'Fuskar du?';
endif;
?>