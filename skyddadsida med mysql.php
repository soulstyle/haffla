<!DOCTYPE HTML>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<html>
	<head>
		<title>Haffla - Guestlist Management tool</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<link href="http://haffla.com/favicon.ico" rel="icon" type="image/x-icon" />
				<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>
	</head>
	<body class="">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						 <?php if (login_check($mysqli) == true) : ?>
						 						<h1>Haffla management</h1>
            <p>Welcome back <?php echo htmlentities($_SESSION['username']); ?>!</p> 
			
										<center>
										<table>
										  <tr>
											<th>Listname</th>
											<th>Unique Views</th>
											<th>Forms</th>
											<th>Creation Date</th>
										  </tr>
										 <tr>
										 <?php
										mysql_query("SELECT * FROM `lists` WHERE uid='$_SESSION['id']'") or trigger_error(mysql_error());
										while($row = mysql_fetch_array($result)){ // skapar arrays av resultatet
										foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
										
										
										echo "<td> <a href="singleview.php&listid="" . nl2br( $row['id']) . ">" . nl2br( $row['name']) . "</a></td>";  
										echo "<td>" . nl2br( $row['uviews']) . "</td>";  
										echo "<td><a href="singleview.php&formid=" . nl2br( $row['nforms']) . "">" . nl2br( $row['forms']) . "</a></td>";  
										echo "<td>" . nl2br( $row['cdate']) . "</td>"; 
										
										/* echo	'<tr>';
										echo	'<td> <a href="singleview.php">$listuid1</a></td>';
										echo	'<td>$listuv1</td>';
										echo	'<td><a href ="viewform1.php">1</a></td>';
										echo	'<td>$listdate1</td>';
										echo  '</tr></a>';
										echo  '<tr>';
										echo	'<td><a href="singleview.php">$listuid2</a></td>';
										echo	'<td>$listuv2</td>';
										echo	'<td><a href ="viewform1.php">1<a/></td>';
										echo	'<td>$listdate2</td>';
										echo  '</tr>'; */
										?>
										</table>
										</center>
												
        <?php else : ?>
            <p>
                <span class="error">You do not have access to view this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
						</nav>
					</header>


				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; <a href="#">Haffla</a> &nbsp;&bull;&nbsp; <a href="newlist.php">Create new list</a> &nbsp;&bull;&nbsp; <!--<a href="newlist.php">View list</a> &nbsp;&bull;&nbsp; --><a href="includes/logout.php">logout</a></span>
					</footer>
				
			</div>
		</div>
	</body>
</html>