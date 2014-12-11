<!DOCTYPE HTML>
<?php
include_once 'includes/registrera.inc.php';
include_once 'includes/functions.php';
include 'includes/template.php';
?>
<?php haffla_header('Register'); ?>
	<body class="loading">
		<div id="wrapper" class="container">
		    <!-- Header -->
			<header id="header">
                <h1>Register</h1>
            </header>
            <div id="content">
                <center>
    				<u>Under Development</u> <br>
                    <?php
                    if (!empty($error_msg)) {
                        echo $error_msg;
                    }
                    ?>
                   <!-- <ul>
                        <li>Anv&auml;ndarnamn f&aring;r endast inneh&aring;lla siffror, versaler, gemener och understreck</li>
                        <li>Emailaddresser m&aring;ste vara i korrekt format</li>
                        <li>L&ouml;senord m&aring;ste best&aring; av minst 6 tecken</li>
                        <li>L&ouml;senord m&aring;ste inneh&aring;lla:
                            <ul>
                                <li>Minst en versal (A..Z Engelska alfabetet)</li>
                                <li>Minst en gemen (a..z Engelska alfabetet)</li>
                                <li>Minst en siffra (0..9)</li>
                            </ul>
                        </li>
                        <li>L&ouml;senordet och bekr&auml;ftelsen m&aring;ste vara exakt lika</li>
                    </ul> -->
                    <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
                        Name:<br> <input type='text' name='username' id='username' /><br>
                        Email:<br> <input type="text" name="email" id="email" /><br>
                        Password:<br> <input type="password" name="password" id="password"/><br>
                        Confirm Password:<br> <input type="password" name="confirmpwd" id="confirmpwd" /><br>
                        <input type="button" value="Register" onclick="return regformhash(this.form,
                           this.form.username,
                           this.form.email,
                           this.form.password,
                           this.form.confirmpwd);" />
                    </form><br>
                    <p>back to <a href="index.php">login</a>.</p>
                </center>
    		</div>
		</div>
        <?php haffla_footer(); ?>
	</body>
</html>