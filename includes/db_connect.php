<?php
include_once 'phpsec-conf.php';   						// Anv�nds f�r att inkludera databasinformationen
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);  	// Anslut till databasen
$mysqli2 = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);  	// Anslut till databasen