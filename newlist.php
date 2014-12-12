<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';
 
sec_session_start(); ?>
<html lang="en">
	<?php haffla_header('New List'); ?>
	<body class="">
		<div id="wrapper" class="container">
			<?php if (login_check($mysqli) == true) : ?>
				<!-- Header -->
				<header id="header">
				 	<h1>Create new list</h1>
				</header>
				<div id="content">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4 text-center">
							<!-- <p>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</p>  -->
							<form role="form">
								<div class="form-group">
									<label for="listname">List name:</label>
									<input class="form-control" type="text" name="listname" placeholder="Name your list">
								</div>
								<!-- Unknown field:<br> <input type="text" name="unknown"><br> -->
								<button type="submit" class="btn btn-primary">Create List</button>
							</form>
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