<!DOCTYPE html>
<?php
session_start();
require_once('config.php');
require_once('session.php');

$ID = $_SESSION['ID'];
		
$ID_Query = "SELECT * FROM User WHERE ID = $ID";

$resultaat = mysqli_query($mysqli, $ID_Query);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <title>Profiel - Ouderavond</title>
    <link rel="stylesheet" href="CSS/profile.css">
</head>
<body>
    <!-- navbar begint hier -->
    <header>
            <img class="logo" src="Assets/logo.png" alt="logo">
            <nav>
                <ul class="nav__links">
                    <li><a href="index.php">Overzicht</a></li>
                    <li><a href="profile.html" class="underline">Profiel</a></li>
                    <li><a href="contact.php">Gegevens</a></li>
                </ul>
            </nav>
            <a href="loguit.php" class="cta">Logout</a>
        </header>
        <!-- navbar eindigt hier -->
    <div class="profile">
        <img src="Assets/logo.png" alt="foto" id="profile_picture">
        <a href="edit.php"><p style="color: black;">Gegevens bewerken</p></a>
        <h1><?php 
		    
			$Ouder_Query = "SELECT US.Email, OU.ID, OU.ID_User, OU.Naam FROM Ouder AS OU LEFT OUTER JOIN User AS US ON US.ID = OU.ID_User WHERE US.ID = $ID";
			
			$Result_Ouder = mysqli_query($mysqli, $Ouder_Query);
			
			$Ouder_Fetch = mysqli_fetch_array($Result_Ouder);
			
			echo $Ouder_Fetch['Naam'];
			
			?></h1><!-- naam halen uit de DB -->
        <form action="" method="post">
            <div class="email">
                <label>Email</label><input type="email" name="email" id="email" placeholder="<?php echo $Ouder_Fetch['Email']; ?>" value="">
            </div>
            <div class="wachtwoord">
                <label>Oude Wachtwoord</label><input type="password" name="OldPass" id="wachtwoord" placeholder="*********">
            </div>
			<div class="wachtwoord">
                <label>Nieuwe Wachtwoord</label><input type="password" name="NewPass" id="wachtwoord" placeholder="*********">
            </div>
			<div class="wachtwoord">
                <label>Bevestig Wachtwoord</label><input type="password" name="Confirm" id="wachtwoord" placeholder="*********">
            </div>
            <input type="submit" id="submit" name="Login" value="Wijziging uitvoeren" onClick="submit()">
        </form>
		
		<?php

    $old_password = $_POST['OldPass'];
    $new_password = $_POST['NewPass'];
    $new1_password = $_POST['Confirm'];

    $result = mysqli_fetch_array($resultaat);
		
		
		if (isset($_POST['Login'])){
		if (sha1($old_password) == $result['Wachtwoord']) {

				if ($new1_password == $new_password) {
					if (strlen($new_password) >= 5 || strlen($new1_password) >= 5) {
						//zorgen voor nog een controle van minimaal aantal characters
						//echo strlen($new_password);
						$new_password = sha1($new_password);
						$query2 = "UPDATE User SET Wachtwoord = '$new_password' WHERE ID = $ID";
						//query aanpassen voor wachtwoord veranderen
						if (mysqli_query($mysqli, $query2)) {
							echo "<script>
									  alert('Uw wachtwoord is gewijzigd');
								  </script>";
						}
							else {
								echo "<script>
									  alert('Het is niet gelukt!');
								  </script>";
							}
						}
						else {
							echo "<script>
									  alert('Uw wachtwoord is niet lang genoeg');
								  </script>";
						}
					 }
				else {
					echo "<script>
							  alert('Uw wachtwoord komt er niet overheen met de nieuwe wachtwoord');
						  </script>";
				}

		}
		else {
			echo "<script>
					  alert('Uw oude wachtwoord is incorrect');
				  </script>";
		}
		}
		
		?>
		<html>
<!--
<head>
    <meta charset="UTF-8">
    <title>hihi</title>
</head>
<body>
<form action="" method="post">
    Old password:
    <input type="text" name="old_password"> <br>
    New password:
    <input type="text" name="new_password"> <br>
    Confirm new password:
    <input type="text" name="new1_password"> <br> <br>
    <input type="submit" name="submit" value="submit">
    <?php
//        require_once "config.pdo.php";
//
//
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//
//    $query = "SELECT password FROM `beroeps-login` WHERE ID = " . $ID;//
//
//    $resultaat = mysqli_query($mysqli, $query);
//
//    sha1($old_password = $_POST['old_password']);
//    $new_password = $_POST['new_password'];
//    $new1_password = $_POST['new1_password'];
//
//    $result = ($rij = mysqli_fetch_array($resultaat));
////    echo sha1($old_password);
////    echo "<br>";
////    echo $result['password'];
//    if (sha1($old_password) == $result['password']) {
//        if (!$new_password == "" || !$new1_password == "") {
//            if ($new1_password == $new_password) {
//                if (strlen($new_password) >= 5 || strlen($new1_password) >= 5) {
//                    //zorgen voor nog een controle van minimaal aantal characters
//                    //echo strlen($new_password);
//                    echo "correct";
//                    $new_password = sha1($new_password);
//                    $query2 = "UPDATE `beroeps-login` SET `password` = '$new_password' WHERE `ID` = " . $ID;
//                    //query aanpassen voor wachtwoord veranderen
//                    if (mysqli_query($mysqli, $query2)) {
//                        echo "Uw wachtwoord is veranderd";
//                    }
//                        else {
//                            echo "Het is helaas niet gelukt";
//                        }
//                    }
//                    else {
//                        echo "Wachtwoord niet lang genoeg";
//                    }
//                 }
//            else {
//                echo "Wachtwoorden komen niet overeen";
//            }
//        }
//        else {
//            echo "voer wel wat in";
//        }
//    }
//    else {
//        echo "Oude wachtwoord incorrect";
//    }
//    echo $old_password;
//    echo $result['password'];
    ?>
</form>
</body>
</html>
    </div>
</body>
</html>
-->