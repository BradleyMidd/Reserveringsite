<?php

require "config.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'];
$level = "0";

$query = "SELECT `Email` FROM `User` WHERE Email = '$email'";//

$resultaat = mysqli_query($mysqli, $query);

$result = mysqli_fetch_array($resultaat);
echo $result['Email'];
if (mysqli_num_rows($resultaat) > 0) {
    echo "op dit email is al een account gerigteerd";
    exit();
} else {
// Define some constants
    define("RECIPIENT_NAME", "Reservering");
// define( "RECIPIENT_EMAIL", "tim.verberne10@gmail.com" );

    $subject = "New account";
    $bericht = "Uw nieuwe account";

    function random_str(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    )
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        //echo $str;
        return $str;
    }

    $pass = random_str(10);

    //echo $pass;

    $pass2 = sha1($pass);

    $headers = "From: noreply@glr.nl\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "BCC: codestuff4all@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// Read the form values
    $success = false;
    //$senderName = isset($_POST['naam']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['naam']) : "";
    $senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
    $subject = isset($_POST['onderwerp']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['onderwerp']) : "";
    $message = isset($_POST['bericht']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['bericht']) : "";

// If all values exist, send the email
    if ($senderEmail && $subject && $message && $headers) {//$senderName &&
        $message = '<html lang="en"><body>';
        //$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<h1>Hello, </h1><br>';
        $message .= "U heeft geregisteerd met dit email adres: " . $email . "<br>";
        $message .= "Er wordt automatisch een account voor uw gemaakt<br>";
        $message .= "Uw email is: " . $email . "<br>";
        $message .= "En uw wachtwoord is: " . $pass . "<br>";
        //$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
        $message .= "<br>Met vriendelijke groet,<br><br>";
        $message .= "Glr";
        $message .= "</body></html>";


        //$recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
        //$headers = "From: " . "GLR Bestuur" . " " . "noreply@glr.nl" . "";//GLRAUTO@glr.nl
        //$intro = $pass;
//        $msg->body '
//            <!DOCTYPE html>
//                <html lang="en">
//                <head>
//                    <meta charset="UTF-8">
//                    <title>Account</title>
//                </head>
//                <body>
//                <h1>Uw nieuwe account</h1>
//                </body>
//                </html>';
//        $msgBody = "Hier vindt u uw username en password<br><br>";//. Uw nieuwe gebruikersnaam is uw Email: " . $email . ". Uw nieuwe password: " . $pass
//        $msgBody .= "Uw nieuwe gebruikersnaam is uw Email: " . $email;
//        $msgBody .= "<br>Uw nieuwe password: " . $intro;
        $succes = mail($email, $subject, $message, $headers);
//        $mail = mail -> body;

        //Set Location After Successsfull Submission
        $query2 = "INSERT INTO `User` (`ID`, `Email`, `Wachtwoord`, `Level`) VALUES (NULL, '$email' ,'$pass2' , $level)";
        if (mysqli_query($mysqli, $query2)) {
            echo "Uw wachtwoord is veranderd";
            header('Location: inlog.php?message=Successfull');
        }
        else {
            echo "error";
        }

        //header('Location: inlog.php?message=Successfull');
    } else {
        echo "error";
        //Set Location After Unsuccesssfull Submission
        //header('Location: mail.php?message=Failed');
    }
}
    ?>
