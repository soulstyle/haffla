<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';

sec_session_start();

$uname = htmlentities($_SESSION['username']);
$uid = htmlentities($_SESSION['user_id']);
$result = $mysqli->query("SELECT * FROM `members` WHERE id='" . $uid . "'") or trigger_error(mysql_error()); 
while( $row = mysqli_fetch_array($result) ) { // skapar arrays av resultatet
	foreach( $row AS $key => $value ) {
		$row[$key] = stripslashes($value);
	}
	$umail = nl2br( $row['email']);
}
?>
<html lang="en">
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
							<div class="row">
								<div class="col-sm-4">
									<?php
									echo '<img class="img-circle img-thumbnail" src="css/images/sakil.jpg"><br>';
									?>
								</div>
								<div class="col-sm-8">
									<?php
									echo '<p>';
									echo 'Name: ' . $uname . '<br>';
									echo 'Email: ' . $umail . '';
									echo '</p>';
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-6 text-right">
							<a href="newlist.php" class="btn btn-primary">Create a New List »</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-striped table-hover dashboard-table toggle-circle-filled sub-table">
								<thead>
									<tr>
										<th>List Name</th>
										<th data-type="numeric">Signups</th>
										<th data-type="numeric">Unique Views</th>
										<th data-toggle="true" data-type="numeric">Forms <small>(Active)</small></th>
										<th data-type="numeric" data-sort-initial="descending">Created</th>
										<th data-hide="all" data-sort-ignore="true">Forms</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// Hämtar användarens listor från 'lists' table i databasen
									$list_result = $mysqli2->query("SELECT * FROM `lists` WHERE owneruid='" . $uid . "'") or trigger_error(mysql_error()); 
									while( $list = mysqli_fetch_array($list_result) ) {
										foreach($list AS $key => $value) { // skapar arrays av resultatet
											$list[$key] = stripslashes($value);
										}
										echo '<tr>';
										echo '<td><a href="svsql.php?listid='. nl2br($list['id']) . '">'. nl2br( $list['listname']) . '</a></td>';
										echo '<td>'. nl2br( $list['signups']) . '-</td>';
										echo '<td>'. nl2br( $list['uviews']) . '-</td>';
										echo '<td>'. nl2br( $list['forms']) . ' (View)</td>';
										echo '<td data-value="'. nl2br( $list['cdateunix']) . '">'. nl2br( $list['creationdate']) . '</td>';
										echo '<td>';
										echo '<table class="sub-table-inner table">';
										// List forms table header - behövs inte just nu
										// echo '<thead><tr>';
										// echo '<th>Form Name</th>';
										// echo '<th>Signups</th>';
										// echo '<th>Views</th>';
										// echo '<th>Active</th>';
										// echo '<th>Created</th>';
										// echo '</tr></thead>';
										echo '<tbody>';
										// Hämta forms från databasen
										$forms_result = $mysqli2->query("SELECT * FROM `forms` WHERE listid='" . nl2br($list['id']) . "'") or trigger_error(mysql_error()); 
										
										// Load Signups from database
										//$guest_result = $mysqli2->query("SELECT `fromform`, COUNT(*) FROM `guests` WHERE listid='" . nl2br($list['id']) . "' GROUP BY `fromform`") or trigger_error(mysql_error());
										//var_dump($guest_result);
										while( $form = mysqli_fetch_array($forms_result) ) {
											foreach($form AS $key => $value) { // skapar arrays av resultatet
												$form[$key] = stripslashes($value);
											}
											$active = '';
											if ($form['active'] == 1) {
												$active = 'checked="checked"';
											}
											echo '<tr>';
											echo '<td><a target="_blank" href="viewform.php?listid='. nl2br( $form['listid']) . '&formid=' . $form['id'] . '">' . $form['formname'] . '</a> <i class="fa fa-external-link"></i></td>';
											echo '<td>'. nl2br( $form['signups']) . '-</td>';
											echo '<td>'. nl2br( $form['uviews']) . '-</td>';
											echo '<td><input class="form-active" type="checkbox" ' . $active . ' name="active" value="1" data-form-id="' . $form['id'] . '"></td>';
											echo '<td data-value="'. nl2br( $form['cdateunix']) . '">' . $form['creationdate'] . '</td>';
											echo '</tr>';
										}
										// Create new Form button - ingen funktion ännu.
										echo '<tr><td colspan="4">';
										echo '<a class="" href="newform.php?listid=' . nl2br($list['id']) . '"><i class="fa fa-plus-circle"></i> Add Form</a>';
										echo '</td></tr>';
										echo '</tbody>';
										echo '</table>';
										echo '</td>';
										echo '</tr>'; 
									} ?>
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