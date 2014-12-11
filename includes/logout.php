<?php
include_once 'functions.php';
sec_session_start();
 
// Tar bort alla sessionsv�rden
$_SESSION = array();
 
// H�mtar sessionsparametrar.
$params = session_get_cookie_params();
 
// Tar bort aktuell cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// F�rst�r sessionen 
session_destroy();
header('Location: ../index.php');