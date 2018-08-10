<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Services</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
          <ul style="margin-left:-70%;">
            <a href="../?link=artsnculture"><li>arts and culture</li></a>
            <a href="../?link=exhibition"><li>exhibition</li></a>
            <a href="../?link=festivals"><li>festivals</li></a>
            <a href="../?link=fundraising"><li>fundraising</li></a>
            <a href="../?link=sporting"><li>sports</li></a>
          </ul>
        </li></a>
        <a href="../contacts"><li>contacts</li></a>
        <a href="index.php"><li class="dropdown">SUPPLIERS
          <ul>
            <a href="https://www.pigiame.co.ke/chairs-tables-for-hire/tents-tables-and-chairs-for-hire-1108815?utm_source=the-star.co.ke" target="_blank"><li>tents</li></a>
            <a href="https://www.pigiame.co.ke/chairs-tables-for-hire/tents-tables-and-chairs-for-hire-1108815?utm_source=the-star.co.ke" target="_blank"><li>chairs</li></a>
            <a href="https://www.pigiame.co.ke/djs-sound-systems-for-hire" target="_blank"><li>sound systems</li></a>
            <a href="http://www.limecatering.co.ke/for-hire.html" target="_blank"><li>catering</li></a>
          </ul>
        </li></a>
        <a href="../orders"><li>orders</li></a>
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
        <br><br><br>
      </div>
    </div>
  </body>
</html>
