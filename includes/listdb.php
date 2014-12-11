<?php
// Anslut till mysql
$link = mysql_connect('mysql07.citynetwork.se', '102298-ko50393', 'haffla13dev');
if (!$link) {
    die('Not connected : ' . mysql_error());  // Misslyckad
}

// Väljer databas
if (! mysql_select_db('102298-hafflalists') ) {
    die ('Can\'t use 102298-hafflalists : ' . mysql_error());  // Hittar inte databasen eller har inte åtkomst
}