<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
	$error = 'Oops! A unexpected error occured.';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Haffla - error!</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4 text-center">
					<h1>Something went wrong</h1>
					<p class="error"><?php echo $error; ?></p>
				</div>
			</div>
		</div>
	</body>
</html>