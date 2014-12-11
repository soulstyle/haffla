<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';

sec_session_start();
?>
<?php haffla_header('Dashboard'); ?>
	
	<body class="">
		<div id="wrapper" class="container">
			<?php if (login_check($mysqli) == true) : ?>
				<!-- Header -->
				<header id="header">
				 	<h1>haffla.com</h1>
				</header>
				<div id="content">
					<div id="user-info" class="row">
						<div class="col-sm-6 text-left">
							<?php 
							$uname = htmlentities($_SESSION['username']);
							$umail = htmlentities($_SESSION['email']);
							
							echo '<p>';
							echo '<img src="http://dummyimage.com/150/ccc/fff&text=Avatar"> <br>';						
							echo ' Name: ' . $uname . ' <br>';
							echo ' Email: ' . $umail . ' ';
							echo '</p>'; ?>
						</div>
						<div class="col-sm-6 text-right">
							<a href="newlist.php" class="btn btn-primary">Create a New List »</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table footable">
								<thead>
									<tr>
										<th>Listname</th>
										<th data-type="numeric">Unique Views</th>
										<th data-type="numeric">Forms</th>
										<th data-type="numeric" data-sort-initial="descending">Creation Date</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td> <a href="singleview.php">$listuid1</a></td>
										<td>143</td>
										<td><a href ="viewform1.php">1</a></td>
										<td data-value="1397939840">19 Apr 2014</td>
									</tr></a>
									<tr>
										<td><a href="singleview.php">$listuid2</a></td>
										<td>59</td>
										<td><a href ="viewform1.php">1</a></td>
										<td data-value="1411850240">27 Sept 2014</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
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