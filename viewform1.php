<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';
 
sec_session_start(); ?>
<html lang="en">
	<?php haffla_header(); ?>
	<body class="">
		<div id="wrapper" class="container">
			<!-- Header -->
			<header id="header">
			 	<h1>Testlista</h1>
			</header>
			<div id="content">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 text-center">
    					<!-- <p>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</p>  -->
						<?php
						/*
							$mysqli->query("SELECT * FROM `forms` WHERE uid='$_SESSION['id']'") or trigger_error(mysqli_connect_errno());
							while($row = mysqli_fetch_array($result)){ // skapar arrays av resultatet
							foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 	
							
							
							" . nl2br( $row['fimage']) . "   	form image
							" . nl2br( $row['fdesc']) . "		form description 
						*/	
						$listid = $_GET["listid"];
						$fromform = '1';
						$datum = getdate(date("U"));
						$signupdate = "$datum[mday]/$datum[mon] - $datum[year] - $datum[hours]:$datum[minutes]";
						$sdateunix = $datum[0];

						if (isset($_POST['submitted'])) {
							foreach($_POST AS $key => $value) {
								$_POST[$key] = $mysqli2->real_escape_string($value);
							} 
							$sql = "INSERT INTO `guests` ( `name` ,  `lastname` ,  `age` ,  `signupdate` , `sdateunix`  , `fromform` , `listid` ) VALUES (  '{$_POST['name']}' ,  '{$_POST['lastname']}' ,  '{$_POST['age']}' ,  '" . $signupdate . "' ,  '" . $sdateunix . "' ,  '" . $fromform . "' ,  '" . $listid . "'   ) ";
							$mysqli2->query($sql) or die(mysqli_connect_errno()); 

							//Skriv ut vid lyckad ny inlaggd film
							echo "<h1>You were successfully added to the guestlist! </h1><br />";
							echo "<br><br>";
							echo "Sign up more guests? Click <a href='viewform1.php?listid=$listid'>here</a>";
							//echo "<a href='viewlist.php'>Back To guestlist</a>";
						}
						if(!isset($_POST['submitted'])) {
							?>

							<img class="img-thumbnail" src='https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-xpa1/t31.0-8/p600x600/10834868_877688255583896_876656232974850241_o.jpg' />
							<p>Beskrivning av eventet.</p>
							
							<form role="form" action='' method='POST'> 
	  							<div class="form-group">
									<label for="name">Name:</label>
									<input class="form-control" type='text' name='name'/>
								</div>
	  							<div class="form-group">
									<label for="lastname">Lastname:</label>
									<input class="form-control" type='text' name='lastname'/>
								</div>
	  							<div class="form-group">
									<label for="age">Age:</label>
									<input class="form-control" type='text' name='age'/>
								</div>
								<input type='hidden' value='1' name='submitted' /></p>
								<button type='submit' class='btn btn-primary'>Submit</button>
							</form>
							<?php
						} ?>
				 		<!-- <p>If you are done you can <a href="includes/logout.php">logout</a>.</p> -->
			 		</div>
			 	</div>
			</div>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>