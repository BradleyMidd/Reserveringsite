<?php
session_start();
require_once('config.php');
require_once('session.php');

$ID = $_SESSION['ID'];

$Query = "SELECT Ouder.ID, Ouder.ID_User, Ouder.Naam, Ouder.Leerling FROM User LEFT OUTER JOIN Ouder ON Ouder.ID_User = User.ID WHERE User.ID = $ID";

$resultaat = mysqli_query($mysqli, $Query);

$row = mysqli_fetch_array($result_ouderavond)

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="" method="post">

        <input type="hidden" name="id_user" value="<?php echo $ID ?>">
        <p>Naam:</p><input type="text" name="naam" value="<?php $row['Naam'] ?>">
        <p>Leerling:</p><input type="text" name="leerling" value="<?php $row['Leerling'] ?>">
        <input type="submit" name="submit" value="Submit">

</form>

<?php
if(isset($_POST['submit']))
{
    $ID_User = $_POST['id_user'];
    $Naam = $_POST['naam'];
    $Leerling = $_POST['leerling'];

    $Gegevens = "INSERT INTO `Ouder`(`ID`, `ID_User`, `Naam`, `Leerling`) VALUES (NULL, '$ID_User', '$Naam', '$Leerling')";

    $result = mysqli_query($mysqli, $Gegevens);


    if($result)
    {
        echo "<script>
				alert('Gelukt');";
        echo "window.location.href = 'profile.php'";
        echo	  "</script>";
        exit;
    }

    else
    {
        echo "<script>
                        alert('Er ging wat mis!');
                      </script>";
        echo "<script>
						  window.history.back();
                      </script>";

    }

}
?>
</body>
</html>