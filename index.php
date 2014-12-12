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
<html lang="en">
	<?php haffla_header('Guestlist Management Tool'); ?>
	<body>
		<div id="wrapper" class="container">
			<!-- Header -->
			<header id="header">
				<h1>haffla.com</h1>
			</header>
			<div id="content">
				<div class="row">
					<div class="col-xs-12 text-center">
						<p><u>Under Development</u></p>
						<?php
						if (isset($_GET['error'])) {
							echo '<p class="error">Error Logging In!</p>';
						}
						?>
					</div>
				</div>
				<form class="col-sm-4 col-sm-offset-4" action="includes/loginprocess.php" method="post" name="login_form">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" placeholder="Enter email" /></p>
					</div>
					<div class="form-group">
						<label for ="password">Password:</label>
						<input type="password" class="form-control" name="password" id="password"/></p>
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" onclick="formhash(this.form, this.form.password);">Login</button>
					</div>
				</form>
				<div class="row">
					<div class="col-xs-12 text-center">
						<p>Dont have a login? <a href="registrera.php">register</a>.</p>
					</div>
				</div>
			</div>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>