<?php
## database logingegevens ##
$db_hostname = 'localhost'; // Deze laat je zo staan!
$db_username = 'db82737_beroeps'; // hier komt jouw FTP username
$db_password = 'Bradley123!';
//--> Bijv. :: https://passwordsgenerator.net/
$db_database = 'Beroeps_Database'; // Je kan maximaal 5 databases aanmaken op https://pma.ict-lab.nl/



## Onderstaande gegevens hoef je niet aan te passen, maar de variabel $con moet je in je verdere scripts gebruiken, 
## of deze hernoemen welke variabelenaam jouw voorkeur heeft:

## maak de database-verbinding ##
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

## foutmelding bij geen verbinding ##
if (!$mysqli) {
    echo "FOUT: geen connectie naar database. <br>";
	echo "Errno: " . mysqli_connect_errno() . "<br/>";
	echo "Error: " . mysqli_connect_error() . "<br>";
    exit;
}
?>