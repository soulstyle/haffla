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
							//$umail = htmlentities($_SESSION['email']);
							$umail = 'demo@haffla.com'; // Tillfällig e-post tills den riktiga finns med i sessionen
							
							echo '<p>';
							echo '<img class="img-circle img-thumbnail" src="/css/images/sakil.jpg"><br>';						
							echo 'Name: ' . $uname . '<br>';
							echo 'Email: ' . $umail . '';
							echo '</p>'; ?>
						</div>
						<div class="col-sm-6 text-right">
							<a href="newlist.php" class="btn btn-primary">Create a New List »</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-striped table-hover footable toggle-circle-filled sub-table">
								<thead>
									<tr>
										<th>Listname</th>
										<th data-type="numeric">Unique Views</th>
										<th data-toggle="true" data-type="numeric">Forms</th>
										<th data-type="numeric" data-sort-initial="descending">Creation Date</th>
										<th data-hide="all" data-sort-ignore="true">Forms</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="singleview.php">$listuid1</a></td>
										<td>143</td>
										<td>1</td>
										<td data-value="1397939840">19 Apr 2014</td>
										<td>
										</td>
									</tr>
									<tr>
										<td><a href="singleview.php">$listuid2</a></td>
										<td>59</td>
										<td><a href ="viewform1.php">1</a></td>
										<td data-value="1411850240">27 Sept 2014</td>
										<td>
											<table class="sub-table-inner table">
												<thead>
													<tr>
														<th>Form Name</th>
														<th>Signups</th>
														<th>Views</th>
														<th>Active</th>
														<th>Created</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><a href ="viewform1.php">VIP Guest</a> <i class="fa fa-external-link"></i></td>
														<td>24</td>
														<td>56</td>
														<td><input type="checkbox" checked="checked" name="active" value="1"></td>
														<td>27 Sept 2014</td>
													</tr>
												</tbody>
											</table>
										</td>
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