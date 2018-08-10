<?php require_once '../engine/infused_cogs.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ticket</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <style media="screen">
      .container-form{
        padding:5%;
      }
    </style>
  </head>
  <body style="background-color:#dfdfdf;">

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
        <div class="col-sm-12" >
          <?php

          if (isset($_GET['ticket_number']) && $_GET['ticket_number'] != '') {
            $code = $_GET['ticket_number'];
            getTicket($code);
          }else {
            header('location ../');
          }

           ?>
        </div>
      </div>
    </div>
  </body>
</html>
