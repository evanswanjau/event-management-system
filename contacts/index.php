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
  </head>
  <body style="background-color:#dfdfdf;">

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
        <?php
          if (isset($_SESSION['user'])) {
            echo '<a href="profile"><li>profile</li></a>';
          }
         ?>
      </ul>
    </div>

    <div class="container-fluid container-form">
      <div class="row">
        <div class="col-sm-12 contacts">
          <h1>Leave us a message</h1>
          <ul>
            <li><b>email:</b> book@eventmanagement.com</li>
            <li><b>call:</b> 0700112233</li>
          </ul>
          <form class="ui-form" action="" method="post">
            <?php newMessage(); ?>
            <input type="text" name="name" placeholder="full name"><br><br>
            <input type="email" name="email" placeholder="email"><br><br>
            <input type="text" name="phone" placeholder="phone number"><br><br>
            <textarea name="message" rows="5" cols="80" placeholder="Send us a message ..."></textarea><br><br>
            <input type="submit" name="send-message" value="send message">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
