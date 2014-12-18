<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';
 
sec_session_start(); ?>
<html lang="en">
	<?php haffla_header('New Form'); ?>
	<body class="">
		<div id="wrapper" class="container">
			<?php if (login_check($mysqli) == true) : ?>
				<!-- Header -->
				<header id="header">
				 	<h1>Create new Form</h1>
				</header>
				<div id="content">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3 text-center">
							<?php
							$listid = $_GET["listid"];
							$datum = getdate(date("U"));
							$listdate = "$datum[mday]/$datum[mon] - $datum[year] - $datum[hours]:$datum[minutes]";
							$owner = htmlentities($_SESSION['username']);
							$ownerid = htmlentities($_SESSION['user_id']);
							echo "<p>Owner : $owner | Owner ID: $ownerid | Datum: $listdate | Unix: $datum[0]</p>"; 
							
							if (isset($_POST['submitted'])) {
								foreach($_POST AS $key => $value) {
									$_POST[$key] = $mysqli2->real_escape_string($value);
								} 
								$sql = "INSERT INTO `forms` ( `formname` , `owner` , `owneruid` , `creationdate` , `cdateunix`, `listid` ) VALUES ( '{$_POST['formname']}' , ' " . $owner . "' , '" . $ownerid . "' , '" . $listdate . "', '" . $datum[0] . "', '" . $listid . "' ) "; 
								$mysqli2->query($sql) or die( mysqli_connect_errno() ); 

								//Skriv ut vid lyckad ny skapad lista
								echo "<h1>Form Successfully created!</h1><br />";
								echo "<br>";
								echo "<a href='newform.php?listid=$listid'>Add another Form</a><br />";
								echo "<a href='dashboard.php'>Back to the dashboard</a>";
								//echo "<a href='viewlist.php'>Back To guestlist</a>";
							}
							if(!isset($_POST['submitted'])){
								?>
								<form role="form" method="POST">
									<div class="form-group">
										<label for="formname">Form name:</label>
										<input class="form-control" type="text" name="formname" id="formname" placeholder="Name your form">
									</div>
									<input type='hidden' value='1' name='submitted' />
									<button type="submit" class="btn btn-primary">Create Form</button>
								</form>
							<?php } ?>
				 			<!-- <p>If you are done you can <a href="includes/logout.php">logout</a>.</p> -->
				 		</div>
				 	</div>
			 	</div>
    		<?php else : ?>
    			<header id="header">
				 	<h1>haffla.com</h1>
				</header>
				<div id="content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<p>
								<span class="error">You do not have access to view this page.</span> Please <a href="index.php">login</a>.
							</p>
						</div>
					</div>
				</div>
    		<?php endif; ?>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>