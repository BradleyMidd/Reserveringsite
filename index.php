<!DOCTYPE html>
<?php
session_start();
require 'config.php';
require 'session.php';

$Email = $_SESSION['Email'];
$Level = $_SESSION['Level'];
$ID = $_SESSION['ID'];
$Klas = $_SESSION['Klas'];

$klas_query = "SELECT DISTINCT Klas FROM Klas LEFT OUTER JOIN Ouderavond AS OA ON Klas.ID = OA.ID_Klas LEFT OUTER JOIN Ouder AS OU ON OA.ID_Ouder = OU.ID LEFT OUTER JOIN User ON OU.ID_User = User.ID WHERE User.ID = $ID";



if ($Level > 0) 
{
	$OuderAvond = "SELECT DO.Naam AS Docentnaam, OU.Naam AS Oudernaam, OU.Leerling, OA.ID AS OuderavondID, OA.Date,OA.StartTijd,OA.EindTijd, OA.Status, OA.Opmerking, OA.Minuten FROM Ouderavond AS OA LEFT OUTER JOIN Ouder AS OU ON OU.ID = OA.ID_Ouder LEFT OUTER JOIN Docent AS DO ON DO.ID = OA.ID_Docent WHERE OA.Status != 'Afgelopen'";
	
	$Geschiedenis = "SELECT DO.Naam AS Docentnaam, OU.Naam AS Oudernaam, OU.Leerling,KL.Klas,OA.StartTijd,OA.EindTijd, OA.Opmerking, OA.Status FROM Ouderavond AS OA LEFT OUTER JOIN Ouder AS OU ON OU.ID = OA.ID_Ouder LEFT OUTER JOIN Docent AS DO ON DO.ID = OA.ID_Docent LEFT OUTER JOIN Klas AS KL ON KL.ID = OA.ID_Klas WHERE OA.Status = 'Afgelopen'";
	
}

else 
{
	$OuderAvond = "SELECT DO.Naam AS Docentnaam, OU.Naam AS Oudernaam, OU.Leerling,OA.Date,OA.StartTijd,OA.EindTijd, OA.Status, OA.Opmerking, OA.Minuten, US.Email FROM Ouderavond AS OA LEFT OUTER JOIN Ouder AS OU ON OU.ID = OA.ID_Ouder  LEFT OUTER JOIN Docent AS DO ON DO.ID = OA.ID_Docent LEFT OUTER JOIN User AS US ON US.ID = OU.ID_User
	WHERE OA.ID_Ouder = $ID AND OA.Status != 'Afgelopen'";
	
	$Geschiedenis = "SELECT DO.Naam AS Docentnaam, OU.Naam AS Oudernaam, OU.Leerling,KL.Klas,OA.StartTijd,OA.EindTijd, OA.Opmerking, OA.Status FROM Ouderavond AS OA LEFT OUTER JOIN Ouder AS OU ON OU.ID = OA.ID_Ouder LEFT OUTER JOIN Docent AS DO ON DO.ID = OA.ID_Docent LEFT OUTER JOIN Klas AS KL ON KL.ID = OA.ID_Klas WHERE OA.ID_Ouder = $ID AND OA.Status = 'Afgelopen'";
}


$result_ouderavond = mysqli_query($mysqli, $OuderAvond);

$result_geschiedenis = mysqli_query($mysqli, $Geschiedenis);

$result_klas = mysqli_query($mysqli, $klas_query);

$fetch = mysqli_fetch_array($result_klas);

?>
<html lang="nl">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="32x32" href="Assets/favicon-32x32.png">
    <link rel="stylesheet" href="CSS/main.css">
    <script src="https://kit.fontawesome.com/da00795f76.js" crossorigin="anonymous"></script>
    <title>Overzicht - Ouderavond</title>
  </head>
  <header>
      <img class="logo" src="Assets/logo.png" alt="logo">
        <nav>
            <ul class="nav__links">
                <li><a href="index.php" class="underline">Overzicht</a></li>
                <li><a href="profile.php">Profiel</a></li>
                <li><a href="contact.php">Gegevens</a></li>
            </ul>
        </nav>
        <a href="loguit.php" class="cta">Logout</a>
  </header>

  <body>
     <div class="border">
       <div id="klas">Welkom bij klas <?php echo $fetch['Klas']; ?></div>

       <div id="tekst">Hier vindt u alle ouderavonden die op dit moment beschikbaar zijn.<br>
         Klik op een van de onderstaande ouderavonden die beschikbaar zijn en schrijf u in!</div>
      </div>
	  
    <div class="Overzicht">
     <h2>Overzicht</h2>
      <section>
          <!-- Ouderavonden -->

          <a href="inschrijven.php">Inschrijven ouderavond</a>
          <?php
          if ($Level > 0) {
              echo '<form action="#" method="post"><input type="submit" value="bevestig" name="bevestig"></form>';
              echo '<form action="#" method="post"><input type="submit" value="definitief" name="definitief"></form>';
          }
          ?>

		  <?php
    echo "<div class='table-wrapper'>";
        echo "<table class='fl-table'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Ouder</th>";
		            echo "<th>Docent</th>";
                    echo "<th>Leerling</th>";
                    echo "<th>Datum</th>";
                    echo "<th>Starttijd</th>";
                    echo "<th>Eindtijd</th>";
                    echo "<th>Status</th>";
                    echo "<th>Opmerking</th>";
                    echo "<th>Minuten</th>";
		  			echo "<th></th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result_ouderavond)) {
				echo "<form action='' method='post'>";
                echo "<tr>";
                echo "<input type='hidden' name='id' value='" . $row['OuderavondID'] . "'><p></p>";
                echo "<td>" . $row['Oudernaam'] . "</td>";
                echo "<td>" . $row['Docentnaam'] . "</td>";
				echo "<td>" . $row['Leerling'] . "</td>";
                echo "<td><input type='text' name='date' value='" . $row['Date'] . "'><i class='fa fa-pencil'></td>";
                echo "<td><input type='text' name='start' value='" . $row['StartTijd'] . "'><i class='fa fa-pencil'></td>";
                echo "<td><input type='text' name='eind' value='" . $row['EindTijd'] . "'><i class='fa fa-pencil'></td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "<td><input type='text' name='opmerking' value='" . $row['Opmerking'] . "'><i class='fa fa-pencil'></td>";
                echo "<td><input type='text' name='minuten' value='" . $row['Minuten'] . "'><i class='fa fa-pencil'></td>";
				echo "<td><button type='submit' name='submit'>Update</button></td>";
                echo "</tr>";
				echo "</form>";
				
            }
            echo "<tbody>";
        echo "</table>";
    echo "</div>";?>

		  <?php
		  if(isset($_POST['submit'])){
          if ($row['Status'] != 'bevestig' && $row['Status'] != 'definitief') {
              $id_get = $_POST['id'];
              $date = $_POST['date'];
              $start = $_POST['start'];
              $eind = $_POST['eind'];
              $opmerking = $_POST['opmerking'];
              $minuten = $_POST['minuten'];

              $update = "UPDATE Ouderavond SET Date = '$date', StartTijd = '$start', EindTijd = '$eind', Opmerking = '$opmerking', Minuten = '$minuten' WHERE Ouderavond.ID = $ID";

              $result_update = mysqli_query($mysqli, $update);

              if ($result_update) {
                  echo "<script>
				alert('Het bewerken is gelukt');";
                  echo "window.location.href = 'index.php'";
                  echo "</script>";
                  exit;
              } else {
                  echo "Error";
                  var_dump($update);

              }

          }
			  
		  }

          else if(isset($_POST['bevestig'])){
              $bevestigRow = mysqli_fetch_array($result_ouderavond);
              $bevestigID = $row['Docentnaam'];
              //var_dump($ID);
              $bevestig = "UPDATE `Ouderavond` SET `Status` = 'bevestig' WHERE `ID_Docent` = '$ID'";
              $bevestigUpdate = mysqli_query($mysqli, $bevestig);
              if ($bevestigUpdate) {
                  echo "het is gelukt";
              }
          }

          else if(isset($_POST['definitief'])){
              $bevestigRow = mysqli_fetch_array($result_ouderavond);
              $bevestigID = $row['Docentnaam'];
              //var_dump($ID);
              $bevestig = "UPDATE `Ouderavond` SET `Status` = 'definitief' WHERE `ID_Docent` = '$ID'";
              $bevestigUpdate = mysqli_query($mysqli, $bevestig);
              if ($bevestigUpdate) {
                  echo "het is gelukt";
              }
          }
		  
		  ?>
		  
      </section>
    </div>

    <div class="Geschiedenis">
     <h2>Geschiedenis</h2>
      <section>
          <!-- Eerdere gesprekken -->
		  
		  <?php
    echo "<div class='table-wrapper'>";
        echo "<table class='fl-table'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Ouder</th>";
		            echo "<th>Docent</th>";
                    echo "<th>Leerling</th>";
                    echo "<th>Klas</th>";
                    echo "<th>Start Tijd</th>";
		            echo "<th>Eind Tijd</th>";
                    echo "<th>Status</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row2 = mysqli_fetch_array($result_geschiedenis)) {
                echo "<tr>";
                echo "<td>" . $row2['Oudernaam'] . "</td>";
                echo "<td>" . $row2['Docentnaam'] . "</td>";
				echo "<td>" . $row2['Leerling'] . "</td>";
                echo "<td>" . $row2['Klas'] . "</td>";
                echo "<td>" . $row2['StartTijd'] . "</td>";
                echo "<td>" . $row2['EindTijd'] . "</td>";
                echo "<td>" . $row2['Status'] . "</td>";
                echo "</tr>";
            }
            echo "<tbody>";
        echo "</table>";
    echo "</div>";
    ?> 

      </section>
    </div>
  </body>

  <footer></footer>
</html>
