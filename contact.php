<!DOCTYPE html>
<?php
require_once('session.php');
?>
<html lang="nl">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <meta charset="utf-8">
    <title>Gegevens - Ouderavond</title>
  </head>
  <header>
      <img class="logo" src="Assets/logo.png" alt="logo">
        <nav>
            <ul class="nav__links">
                <li><a href="index.php">Overzicht</a></li>
                <li><a href="profile.php">Profiel</a></li>
                <li><a href="contact.php" class="underline">Gegevens</a></li>
            </ul>
        </nav>
        <a href="loguit.php" class="cta">Logout</a>
  </header>
  <body>
    <section>
    <div class="adres">
      <h3>Adres</h3>
        <p>Heer Bokelweg 255
           3032AD Rotterdam</p>
    </div>

    <div class="contact">
      <h3>Contact</h3>
        <p>088 200 1500
            info@glr.nl</p>
    </div>
    </section>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2460.346668900474!2d4.475905115785457!3d51.927629979706346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c434a8485bda7d%3A0x5d89cc9d1d5c201a!2sGraphic%20Lyceum%20Rotterdam!5e0!3m2!1sen!2snl!4v1568625404107!5m2!1sen!2snl" width="1200" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </body>
</html>
