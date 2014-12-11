<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';
 
sec_session_start();
?>
<?php haffla_header('New List'); ?>
	<body class="">
		<div id="wrapper" class="container">
			<?php if (login_check($mysqli) == true) : ?>
				<!-- Header -->
				<header id="header">
				 	<h1>Create new list</h1>
				</header>
				<div id="content">
					<center>
						<!-- <p>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</p>  -->
						<p>
						<form>
							List name:<br> <input type="text" name="listname"><br>
							<!-- Unknown field:<br> <input type="text" name="unknown"><br> -->
							<input type="submit" class="btn btn-primary" value="Create List">
						</form>
						</p>
				 		<!-- <p>If you are done you can <a href="includes/logout.php">logout</a>.</p> -->
				 	</center>
			 	</div>
    		<?php else : ?>
    			<header id="header">
				 	<h1>haffla.com</h1>
				</header>
				<div id="content">
					<p>
						<span class="error">You do not have access to view this page.</span> Please <a href="index.php">login</a>.
					</p>
				</div>
    		<?php endif; ?>
		</div>
		<?php haffla_footer(); ?>
	</body>
</html>