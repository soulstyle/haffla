<?php
function haffla_header($title = 'Haffla - Guestlist Management Tool') {
	?>
	<!-- Header -->
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/footable.core.min.css" rel="stylesheet" type="text/css"/>
		<script type="text/JavaScript" src="js/sha512.js"></script> 
		<script type="text/JavaScript" src="js/forms.js"></script> 
		<link rel="stylesheet" href="css/style.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="http://haffla.com/favicon.ico" rel="icon" type="image/x-icon" />
	</head>
	<?php
}

function haffla_footer() {
	$home_link = 'http://' . $_SERVER['SERVER_NAME'];
	// Login check funkar ej... även om functions.php är includerad?
	// if (login_check($mysqli) == true) {
	// 	$home_link = trailingslashit( $home_link ) . 'dashboard.php';
	// }
	?>
	<!-- Footer -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<span class="copyright">&copy; <a href="<?php echo $home_link; ?>">Haffla</a> &nbsp;&bull;&nbsp; <a href="newlist.php">Create new list</a> &nbsp;&bull;&nbsp; <!--<a href="newlist.php">View list</a> &nbsp;&bull;&nbsp; --><a href="includes/logout.php">logout</a></span>
				</div>
			</div>
		</div>
	</footer>
	<!-- Scripts -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script>
		if (!window.jQuery) { document.write('<script src="js/jquery-1.9.1.min.js"><\/script>'); }
	</script>
	<script src="js/footable.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<?php
}

?>