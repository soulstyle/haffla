<?php
include_once 'db_connect.php';
include_once 'phpsec-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Städar upp och validerar datan som skickas
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Ogiltig email
        $error_msg .= '<p class="error">Du angav en felaktig emailaddress!</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Det hashade lösenordet ska vara 128 tecken långt.
        // Om det inte är tillräckligt långt så har något gått snett.
        $error_msg .= '<p class="error">Fel format p&aring; l&ouml;senordet!</p>';
    }
 
    // Validering av användarnamn och lösenord har kollats mot klinten.
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Kollar om emailaddressen redan är registrerad.
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Emailadressen finns redan registrerad på en annan användare.
            $error_msg .= '<p class="error">En anv&auml;ndare med den h&auml;r emailaddressen finns redan!</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
 
    // Kollar om användarnamnet redan finns.
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // Användarnamnet är redan upptaget.
                        $error_msg .= '<p class="error">En anv&auml;ndare med det h&auml;r namnet finns redan!</p>';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 

 
    if (empty($error_msg)) {
        // Skapar nygenererad salt.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Funkar inte?
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Skapar saltat lösenord 
        $password = hash('sha512', $password . $random_salt);
 
        // Skapar användaren i databasen 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Kör SQLfråga.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}