<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <style media="screen">
      .container-form{
        padding-top:5%!important;
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
      <div class="row"style='margin-left:5%;'>
        <form class="ui-form" action="" method="get">
          <input type="text" name="order-code" placeholder="Enter order code"><br><br>
          <input type="submit" name="submit" value="submit">
        </form>

        <?php if (isset($_GET['order-code'])): ?>
          <?php getOrderSearch($_GET['order-code']) ?>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
