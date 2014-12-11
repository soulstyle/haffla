<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';
 
sec_session_start();
?>
<?php haffla_header(); ?>

	<body class="">
		<div id="wrapper" class="container">
			<!-- Header -->
			<header id="header">
			 	<h1>Testlista</h1>
			</header>
			<div id="content">
    			<center>
	    			<!-- <p>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</p>  -->
					<?php
					/*
						$mysqli->query("SELECT * FROM `forms` WHERE uid='$_SESSION['id']'") or trigger_error(mysqli_connect_errno());
						while($row = mysqli_fetch_array($result)){ // skapar arrays av resultatet
						foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 	
						
						
						" . nl2br( $row['fimage']) . "   	form image
						" . nl2br( $row['fdesc']) . "		form description 
					*/	
						$listid = '1';
						$fromform = '1';
						$signupdate = '7 dec 2014';

					if (isset($_POST['submitted'])) { 
						foreach($_POST AS $key => $value) { $_POST[$key] = $mysqli2->real_escape_string($value); } 
						$sql = "INSERT INTO `guests` ( `name` ,  `lastname` ,  `age` ,  `signupdate` , `fromform` , `listid` ) VALUES (  '{$_POST['name']}' ,  '{$_POST['lastname']}' ,  '{$_POST['age']}' ,  '" . $signupdate . "' ,  '" . $fromform . "' ,  '" . $listid . "'   ) "; 
						$mysqli2->query($sql) or die(mysqli_connect_errno()); 

						//Skriv ut vid lyckad ny inlaggd film
						echo "<h1>You were successfully added to the guestlist! </h1><br />";
						echo "<br><br>";
						echo "Sign up more guests? Click <a href='viewform1.php'>here</a>";
						//echo "<a href='viewlist.php'>Back To guestlist</a>";
					}
					if(!isset($_POST['submitted'])){
					print
					("<img src='formimage.png' /><br>
						beskrivning<br><br>
						<form action='' method='POST'> 
						<p><b>Name:</b><br /><input type='text' name='name'/></p>
						<p><b>Lastname:</b><br /><input type='text' name='lastname'/></p>
						<p><b>Age:</b><br /><input type='text' name='age'/></p>
						<p><input type='submit' class='btn btn-primary' value='Submit' /><input type='hidden' value='1' name='submitted' /></p>
						</form>");
						} 
						?>
				 	<!-- <p>If you are done you can <a href="includes/logout.php">logout</a>.</p> -->
			 	</center>
			</div>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>