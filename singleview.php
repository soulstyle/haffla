<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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
<div class="demo-container">
  <!-- <div class="alert">
    Easily filter your FooTables
  </div> -->
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
		<th data-type="numeric" data-sort-initial="true">
                                ID
                            </th>
          <th data-toggle="true">
            First Name
          </th>
          <th data-sort-ignore="true">
            Last Name
          </th>
          <th data-sort-ignore="true" data-hide="phone,tablet">
            From form
          </th>
          <th data-type="numeric" data-hide="phone,tablet">
            Signup date
          </th>
         <!-- <th data-hide="phone">
            Status
          </th> -->
        </tr>
        </thead>
        <tbody>
        <tr>
		<td>2</td>
          <td>Isidra</td>
          <td>Boudreaux</td>
          <td>Form1</td>
          <td data-value="78025368997">22 Jun 1972</td>
        <!--   <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
        </tr>
        <tr>
		<td>3</td>
          <td>Shona</td>
          <td>Woldt</td>
          <td><a href="#">Airline Transport Pilot</a></td>
          <td data-value="370961043292">3 Oct 1981</td>
        <!--   <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>-->
        </tr>
        <tr>
		<td>1</td>
          <td>Granville</td>
          <td>Leonardo</td>
          <td>Form1</td>
          <td data-value="22133780420">19 Apr 1969</td>
        <!--   <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td> -->
        </tr>
        <tr>
		<td>8</td>
          <td>Easer</td>
          <td>Dragoo</td>
          <td>Form1</td>
          <td data-value="250833505574">13 Dec 1977</td>
         <!--  <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td> -->
        </tr>
        <tr>
		<td>4</td>
          <td>Maple</td>
          <td>Halladay</td>
          <td>Form1</td>
          <td data-value="694116650726">30 Dec 1991</td>
         <!--  <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td> -->
        </tr>
        <tr>
		<td>5</td>
          <td>Maxine</td>
          <td>Woldt</td>
          <td>Form2</td>
          <td data-value="561440464855">17 Oct 1987</td>
        <!--   <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td> -->
        </tr>
        <tr>
		<td>6</td>
          <td>Lorraine</td>
          <td>Mcgaughy</td>
          <td>Form2</td>
          <td data-value="437400551390">11 Nov 1983</td>
        <!--   <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td> -->
        </tr>
        <tr>
		<td>9</td>
          <td>Lizzee</td>
          <td>Goodlow</td>
          <td>Form2</td>
          <td data-value="-257733999319">1 Nov 1961</td>
         <!--  <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td> -->
        </tr>
        <tr>
		<td>10</td>
          <td>Judi</td>
          <td>Badgett</td>
          <td>Form2</td>
          <td data-value="362134712000">23 Jun 1981</td>
        <!--   <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td> -->
        </tr>
        <tr>
		<td>7</td>
          <td>Lauri</td>
          <td>Hyland</td>
          <td>Form2</td>
          <td data-value="500874333932">15 Nov 1985</td>
         <!--  <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td> -->
        </tr>
        </tbody>
      </table>
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
