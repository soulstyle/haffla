<!DOCTYPE HTML>
<?php
include_once 'includes/clp.inc.php';
include_once 'includes/functions.php';
include 'includes/template.php';
?>
<html lang="en">
	<?php haffla_header('Set Password'); 
	$listid=$_GET["listid"];
	?>
	<body class="loading">
		<div id="wrapper" class="container-fluid">
		    <!-- Header -->
			<header id="header">
                <h1>Set list password</h1>
            </header>
            <div id="content">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 text-center">
                        <?php
                        if (!empty($error_msg)) {
                            echo $error_msg;
                        }
                        ?>
                        <form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="listpassword_form">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password"/>
                            </div>
                            <div class="form-group">
                                <label for="confirmpwd">Confirm Password:</label>
                                <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" />
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="return regformhash(this.form,this.form.password,this.form.confirmpwd);">Set Password</button>
                        </form><br>
                        <p><a href="svsql.php?listid=<?php echo "$listid";?>">Back to List</a></p>
                    </div>
                </div>
    		</div>
		</div>
        <?php haffla_footer(); ?>
	</body>
</html>