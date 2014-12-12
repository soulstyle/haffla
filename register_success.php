

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
				<h1>Registration Successful!</h1>
			</header>
			<div id="content">
				<div class="row">
                    <div class="col-sm-4 col-sm-offset-4 text-center">
						<p>back to <a href="index.php">login</a>.</p>
					</div>
				</div>
			</div>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>