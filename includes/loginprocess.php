<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // V�rat s�kra s�tt att starta en ny PHP Session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // Det hashade l�senordet.
 
    if (login($email, $password, $mysqli) == true) {
        // Lyckad inloggning.
        header('Location: ../dashboard.php');
    } else {
        // Misslyckad inloggning.
        header('Location: ../index.php?error=1');
    }
} else {
    // Fick aldrig r�tt POST variabler skickat till den h�r sidan. 
    echo 'Ogiltig F&ouml;rfr&ouml;gan';
}