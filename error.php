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
        <h1>Something went wrong</h1>
        <p class="error"><?php echo $error; ?></p>  
    </body>
</html>