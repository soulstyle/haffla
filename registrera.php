<!DOCTYPE HTML>
<?php
include_once 'includes/registrera.inc.php';
include_once 'includes/functions.php';
include 'includes/template.php';
?>
<html lang="en">
	<?php haffla_header('Register'); ?>
	<body class="loading">
		<div id="wrapper" class="container">
			<!-- Header -->
			<header id="header">
				<h1>Register</h1>
			</header>
			<div id="content">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 text-center">
						<p><u>Under Development</u></p>
						<?php
						if (!empty($error_msg)) {
							echo $error_msg;
						}
						?>
					   <!-- <ul>
							<li>Anv&auml;ndarnamn f&aring;r endast inneh&aring;lla siffror, versaler, gemener och understreck</li>
							<li>Emailaddresser m&aring;ste vara i korrekt format</li>
							<li>L&ouml;senord m&aring;ste best&aring; av minst 6 tecken</li>
							<li>L&ouml;senord m&aring;ste inneh&aring;lla:
								<ul>
									<li>Minst en versal (A..Z Engelska alfabetet)</li>
									<li>Minst en gemen (a..z Engelska alfabetet)</li>
									<li>Minst en siffra (0..9)</li>
								</ul>
							</li>
							<li>L&ouml;senordet och bekr&auml;ftelsen m&aring;ste vara exakt lika</li>
						</ul> -->
						<form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
							<div class="form-group">
								<label for="username">Name:</label>
								<input type='text' class="form-control" name='username' id='username' />
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="text" class="form-control" name="email" id="email" />
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" name="password" id="password"/>
							</div>
							<div class="form-group">
								<label for="confirmpwd">Confirm Password:</label>
								<input type="password" class="form-control" name="confirmpwd" id="confirmpwd" />
							</div>
							<button type="submit" class="btn btn-primary" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);">Register</button>
						</form>
						<br />
						<p>back to <a href="index.php">login</a>.</p>
					</div>
				</div>
			</div>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>