<?php
/**
 * Inloggningsdetaljer för databasen
 */

//Använd lokal databas-config om den finns
if ( file_exists( dirname( __FILE__ ) . '/phpsec-conf-local.php' ) ) {
	include( dirname( __FILE__ ) . '/phpsec-conf-local.php' );
} else {
	define("HOST", "mysql14.citynetwork.se");     				// IP/Hostname till databasen som du vill ansluta till
	define("USER", "102298-al56349");    					// Användarnamn i databasen 
	define("PASSWORD", "YoLo8519");   	 	// Lösenord till databasen
	define("DATABASE", "102298-haffla");    			// Databasens namn

	define("HOST2", "mysql07.citynetwork.se");
	define("USER2", "102298-ko50393");
	define("PASSWORD2", "haffla13dev");
	define("DATABASE2", "102298-hafflalists");
}
 
define("CAN_REGISTER", "any");					// Vem som kan registrera
define("DEFAULT_ROLE", "member");				// Standardroll för nyregistrerade medlemmar
 
define("SECURE", FALSE);    					// För vidare utveckling med https