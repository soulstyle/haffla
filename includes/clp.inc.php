<?php
include_once 'db_connect.php';
include_once 'phpsec-config.php';
 
$error_msg = "";
 
if (isset($_POST['p'])) {
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Det hashade lösenordet ska vara 128 tecken långt.
        // Om det inte är tillräckligt långt så har något gått snett.
        $error_msg .= '<p class="error">Fel format p&aring; l&ouml;senordet!</p>';
    }
 
    if (empty($error_msg)) {
        // Skapar nygenererad salt.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Funkar inte?
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Skapar saltat lösenord 
        $password = hash('sha512', $password . $random_salt);
 
        // Skapar användaren i databasen 
        if ($insert_stmt = $mysqli2->prepare("UPDATE 'lists' (listpass, listsalt) VALUES (?, ?) WHERE id='$listid' ")) {
            $insert_stmt->bind_param('ss', $password, $random_salt);
            // Kör SQLfråga.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}