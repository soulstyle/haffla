<!DOCTYPE html>
<?php
include 'includes/db_connect.php';
include_once 'includes/functions.php';
include 'includes/template.php';

sec_session_start();
?>
<html lang="en">
<head>
	<title>Haffla - Viewing List</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no"/>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="css/footable.core.min.css?v=2-0-1" rel="stylesheet" type="text/css"/>
	<link href="css/footable-demos.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script>
		if (!window.jQuery) { document.write('<script src="js/jquery-1.9.1.min.js"><\/script>'); }
	</script>
	<script src="js/footable.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.striping.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/demos.js" type="text/javascript"></script>
</head>
<body>
	<?php if (login_check($mysqli) == true) :
		$listnum = $_GET["listid"];
		// Hämtar listägarid från databasen
		$result = $mysqli2->query("SELECT * FROM `lists` WHERE id='" . $listnum . "'") or trigger_error(mysql_error()); 
		while( $row = mysqli_fetch_array($result) ) { // skapar arrays av resultatet
			foreach($row AS $key => $value) {
				$row[$key] = stripslashes($value);
			}
			$ownerid = nl2br( $row['owneruid']);
		}
		$uid = htmlentities($_SESSION['user_id']);
		
		if ($ownerid == $uid) : ?>
			<center>
				Viewing List as administrator<br>
				Create a password for external viewing <a href="clp.php?listid=<?php echo"$listnum";?>">here</a>.
				<br><a href="dashboard.php">Back to dashboard</a>
			</center>
			<div class="demo-container">
				<div class="tab-content">
					<div class="tab-pane active" id="demo">
						<center>
							<p>
								Search: <input id="filter" type="text"/>
								<a href="#clear" class="clear-filter" title="clear filter">[clear]</a>
							</p>
						</center>
						
						<table class="table demo" data-filter="#filter" data-filter-text-only="true">
							<thead>
								<tr>
									<th data-toggle="true">Name</th>
									<th data-sort-ignore="true">Last Name</th>
									<th data-sort-ignore="true" data-hide="phone,tablet">From form</th>
									<th data-type="numeric" data-hide="phone,tablet">Signup date</th>
								</tr>
							</thead>
							<tbody>
						
							<?php
							// Hämtar gäster från 'guests' table i databasen
							$result = $mysqli2->query("SELECT * FROM `guests` WHERE listid='" . $listnum . "'") or trigger_error(mysql_error()); 
							while($row = mysqli_fetch_array($result)) { // skapar arrays av resultatet
								foreach($row AS $key => $value) {
									$row[$key] = stripslashes($value);
								}
								// Skriver ut alla gäster
								echo "<tr>";  
								echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";
								echo "<td valign='top'>" . nl2br( $row['lastname']) . "</td>";
								echo "<td valign='top'>" . nl2br( $row['fromform']) . "</td>";
								echo "<td valign='top' data-value='". nl2br( $row['sdateunix']) . "'>" . nl2br( $row['signupdate']) . "</td>";
								//echo "<td valign='top'>" . nl2br( $row['status']) . "</td>";  behövs inte än
								//echo "<td valign='top'><a href=edit.php?id={$row['id']}>Edit</a></td><td><a href=delete.php?id={$row['id']}>Delete</a></td> "; 
								echo "</tr>"; 
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php else : ?>
			<p>
				<center><span class="error">This is not your list!</span> Please go back to the <a href="dashboard.php">dashboard</a>.</center>
				<?php echo " <center>devNote: Error - Number is $uid we were expecting $ownerid </center>" ; ?>
			</p>
		<?php endif; ?>
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
	<script type="text/javascript">
		$(function () {
			$('table').footable().bind('footable_filtering', function (e) {
				var selected = $('.filter-status').find(':selected').text();
				if (selected && selected.length > 0) {
					e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
					e.clear = !e.filter;
				}
			});

			$('.clear-filter').click(function (e) {
				e.preventDefault();
				$('.filter-status').val('');
				$('table.demo').trigger('footable_clear_filter');
			});

			$('.filter-status').change(function (e) {
				e.preventDefault();
				$('table.demo').trigger('footable_filter', {filter: $('#filter').val()});
			});
		});
	</script>
	<script type="text/javascript">
		$(function () {
		 $('table').footable();

		 $('.sort-column').click(function (e) {
			e.preventDefault();

									//get the footable sort object
									var footableSort = $('table').data('footable-sort');

									//get the index we are wanting to sort by
									var index = $(this).data('index');

									footableSort.doSort(index, 'toggle');
								});
	 });
	</script>
</body>
</html>
