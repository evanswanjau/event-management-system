<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contacts</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
        <div class="col-sm-12 contacts">
          <h1>Book an event</h1>
          <ul>
            <li><b>email:</b> book@eventmanagement.com</li>
            <li><b>call:</b> 0700112233</li>
          </ul>
          <ul>
            <li style="display:inline-block;"><a href='https://web.facebook.com/dandetroun.gitonga.7' target="_blank"><img src='facebook.png'></a></li>
            <li style="display:inline-block;"><a href='https://chat.whatsapp.com/5FqCZBEWFS7BNeRgsbh5cL' target="_blank"><img src='whatsapp.png'></a></li>
            <li style="display:inline-block;"><a href='https://mail.google.com' target="_blank"'><img src='email.png'></a></li>
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
