<!doctype html>
<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Inloggen</title>
<link rel="icon" href="Assets/489_Logo_GrafischLyceumRotterdam.eps.png">
<link href="CSS/style.css" type="text/css" rel="stylesheet">
</head>

<body>
	
	<?php
	
		if (isset($_POST['Login']))
		{
			//Verbind de config.pdo.php met de inlog.php
			require 'config.php';
			
			//Maak een Gebruikersnaam en Wachtwoord
			$Email = $_POST['Email'];
			$Wachtwoord = sha1($_POST['Wachtwoord']);
			
			$query = "SELECT User.ID AS UserID, User.Email, User.Wachtwoord, User.Level, Klas FROM User, Klas WHERE User.Email = '$Email' AND User.Wachtwoord = '$Wachtwoord'";
			$resultaat = mysqli_query($mysqli, $query);
				
			if (mysqli_num_rows($resultaat) > 0){
				
				$user = mysqli_fetch_array($resultaat);
				$_SESSION['ID'] = $user['UserID'];
				$_SESSION['Email'] = $user['Email'];
				$_SESSION['Level'] = $user['Level'];
				$_SESSION['Klas'] = $user['Klas'];

				
				header('Location: index.php');
		   }    
		        //Als het resultaat leeg is
		else
		  { 
			echo "<p>Gebruikersnaam en/of wachtwoord zijn onjuist";
			echo "<p><a href='inlog.php'>Probeer opnieuw</a></p>";
		  } 
	    }
		else{
	
	?>
	
<!--Hier onder de content van de pagina-->
	<img src="Assets/489_Logo_GrafischLyceumRotterdam.eps.png" width="10%">
	<div class="siteinfo">
        <div class="vaklinks">
			<p>
				<div class="backgroundinloggen">
					<fieldset class="box">
					<p>
            <p>Trial account:
                    82737@glr.nl
                Wachtwoord:
                bradley
            </p>
	<h2 class="inloggentext">Inloggen</h2>
	<form method="post" action="">
			<input type="text" placeholder="Enter Email" name="Email" required><br>
			<br>
			<input type="password" placeholder="Enter Password" name="Wachtwoord" required>
		    <br>
			<a href="password_ect/password_forget.html" class="passforgot">Wachtwoord vergeten</a>
			<br>
			<input class="loginbutton" type="submit" name="Login" value="submit">
		</p>
	</form><br>
</div>
			</p>
        </div>
    </div>
	
	<?php
		}
	?>
	</fieldset>
</body>
</html>