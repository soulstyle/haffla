<?php
/**
 * Inloggningsdetaljer för databasen
 */

//Använd lokal databas-config om den finns
if ( file_exists( dirname( __FILE__ ) . '/phpsec-conf-local.php' ) ) {
	include( dirname( __FILE__ ) . '/phpsec-conf-local.php' );
} else {
	define("HOST", "hostnamn");     				// IP/Hostname till databasen som du vill ansluta till
	define("USER", "username");    					// Användarnamn i databasen 
	define("PASSWORD", "password");   	 	// Lösenord till databasen
	define("DATABASE", "database");    			// Databasens namn

	define("HOST2", "hostnamn");
	define("USER2", "username");
	define("PASSWORD2", "password");
	define("DATABASE2", "database");
}
 
define("CAN_REGISTER", "any");					// Vem som kan registrera
define("DEFAULT_ROLE", "member");				// Standardroll för nyregistrerade medlemmar
 
define("SECURE", FALSE);    					// För vidare utveckling med https
