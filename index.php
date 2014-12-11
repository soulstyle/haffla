<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';

sec_session_start();

if (login_check($mysqli) == true) {
	$logged = 'inloggad';
} else {
	$logged = 'utloggad';
}
?>
<?php haffla_header('Guestlist Management Tool'); ?>
<body class="loading">
	<div id="wrapper" class="container">
		<!-- Header -->
		<header id="header">
			<h1>haffla.com</h1>
		</header>
		<div id="content">
			<center>
				<!-- <p>Guestlist Management &nbsp;&bull;&nbsp; </p> -->
				<p><u>Under Development</u></p>
				<?php
				if (isset($_GET['error'])) {
					echo '<p class="error">Error Logging In!</p>';
				}
				?> 
				<form action="includes/loginprocess.php" method="post" name="login_form">                      
					<p>Email:<br> <input type="text" name="email" /></p>
					<p>Password:<br> <input type="password"  name="password" id="password"/></p>
					<input type="button" class="btn btn-primary" value="Login" onclick="formhash(this.form, this.form.password);" /> 
				</form>
				<p>Dont have a login? <a href="registrera.php">register</a>.</p>
			</center>
		</div>
	</div>
	<?php haffla_footer(); ?>
</body>
</html>