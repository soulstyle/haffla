<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Haffla - Viewing List</title>
  <meta name="viewport" content="width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no"/>
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css"/>
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
<div class="demo-container">
  <div class="tab-content">
    <div class="tab-pane active" id="demo">
	<center>
      <p>
        Search: <input id="filter" type="text"/>
        <a href="#clear" class="clear-filter" title="clear filter">[clear]</a>
      </p>
	  </center>
<?php
include('includes/db_connect.php');

$listnum = '1';


echo '<table class="table demo" data-filter="#filter" data-filter-text-only="true">';
echo        '<thead>';
		echo "<tr>"; 
//echo "<th data-type="numeric" data-sort-initial="true">ID</th>"; behövs inte
echo '<th data-toggle="true">Name</th>';
echo '<th data-sort-ignore="true">Last Name</th>'; 
echo '<th data-sort-ignore="true" data-hide="phone,tablet">From form</th>'; 
echo '<th data-type="numeric" data-hide="phone,tablet">Signup date</th>';
//echo "<th data-hide="phone">Status</th>"; behövs inte
echo '</thead>';
echo        '<tbody>';
echo "</tr>";

// Hämtar gäster från 'guests' table i databasen
$result = $mysqli2->query("SELECT * FROM `guests` WHERE listid='" . $listnum . "'") or trigger_error(mysql_error()); 
while($row = mysqli_fetch_array($result)){ // skapar arrays av resultatet
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

// Skriver ut alla gäster
echo "<tr>";  
//echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  behövs inte
echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['lastname']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['fromform']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['signupdate']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['status']) . "</td>";  behövs inte än
//echo "<td valign='top'><a href=edit.php?id={$row['id']}>Edit</a></td><td><a href=delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
}
echo        '</tbody>';
echo      '</table>'; 
?>

    </div>
  </div>
</div>
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
