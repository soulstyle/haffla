<?php
include_once 'functions.php';
sec_session_start();
 
// Tar bort alla sessionsvärden
$_SESSION = array();
 
// Hämtar sessionsparametrar.
$params = session_get_cookie_params();
 
// Tar bort aktuell cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Förstör sessionen 
session_destroy();
header('Location: ../index.php');