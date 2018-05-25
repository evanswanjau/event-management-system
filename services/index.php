<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Services</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <script src="../js/jquery-ui.min.js"></script>
    <style media="screen">
      .container-form{
        padding-top:5%!important;
      }
    </style>
  </head>
  <body>

    <div class="top-menu">
      <ul>
        <a href="../"><li>home</li></a>
        <a href="../about"><li>about</li></a>
        <a href="../services"><li>services</li></a>
        <a href="../"><li class="dropdown">events
          <ul>
            <a href="../?link=artsnculture"><li>arts and culture</li></a>
            <a href="../?link=exhibition"><li>exhibition</li></a>
            <a href="../?link=festivals"><li>festivals</li></a>
            <a href="../?link=fundraising"><li>fundraising</li></a>
            <a href="../?link=sporting"><li>sports</li></a>
          </ul>
        </li></a>
        <a href="../contacts"><li>contact us</li></a>
        <?php profileLink('../'); ?>
      </ul>
    </div>

    <div class="container-fluid container-form">
      <div class="row">
        <div class="col-sm-12 services-point">
          <h2>OUR SERVICES</h2>
          <p>We take care of all sorts of events from ...</p>
          <div class="col-sm-3 image">
            <img src="../images/background.jpg" alt="Weddings">
            <p>Weddings</p>
          </div>
          <div class="col-sm-3 image">
            <img src="../images/birthday-parties.jpg" alt="birthdays">
            <p>Birthday Parties</p>
          </div>
          <div class="col-sm-3 image">
            <img src="../images/entertainment.jpg" alt="entertainment events">
            <p>Entertainment Events</p>
          </div>
          <div class="col-sm-3 image">
            <img src="../images/private-events.jpg" alt="private events">
            <p>Private Events</p>
          </div>
          <div class="col-sm-3 image">
            <img src="../images/graduation-parties.jpg" alt="graduation parties">
            <p>Graduation Parties</p>
          </div>
        </div>
        <div class="button-style">
          <a href="../contacts">Book Now</a>
        </div>
      </div>
    </div>
  </body>
</html>
