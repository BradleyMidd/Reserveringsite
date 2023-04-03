<?php
//Start de session
session_start();
//Als de gebruiker niet ingelogd is
if($_SESSION['Email'] == true)
{
	//echo $_SESSION['Email'];
	//Stuur de gebruiker direct terug naar 'inlog.php'
	//header('location:inlog.php');
} else {
	header('Location: inlog.php');
}
?>