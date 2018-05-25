<?php require_once '/engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EMS</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  </head>
  <body>

    <div class="top-menu">
      <ul>
        <a href=""><li>home</li></a>
        <a href="about"><li>about</li></a>
        <a href="services"><li>services</li></a>
        <a href="index.php"><li class="dropdown">events
          <ul>
            <a href="?link=artsnculture"><li>arts and culture</li></a>
            <a href="?link=exhibition"><li>exhibition</li></a>
            <a href="?link=festivals"><li>festivals</li></a>
            <a href="?link=fundraising"><li>fundraising</li></a>
            <a href="?link=sporting"><li>sports</li></a>
          </ul>
        </li></a>
        <a href="contacts"><li>contact us</li></a>
        <?php profileLink(); ?>
      </ul>
    </div>

    <div class="container-fluid home-style">
      <div class="row">

        <div class="col-sm-7 home-menu">
          <h1><span>EVENT PLANNING AND MANAGEMENT SYSTEM</span></h1>
          <br>
          <a href="login">login</a>
          <a href="register">register</a>
        </div>
        <div class="col-sm-5 event-container">
          <h1>EVENTS</h1>
          <?php getEvents(); ?>
          <br><br><br><br>
        </div>
      </div>
    </div>
  </body>
</html>
