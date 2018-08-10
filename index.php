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

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="top-menu">
      <ul>
        <a href=""><li>home</li></a>
        <a href="about"><li>about</li></a>
        <a href="services"><li>services</li></a>
        <a href="index.php"><li class="dropdown">events
          <ul style="margin-left:-70%;">
            <a href="?link=artsnculture"><li>arts and culture</li></a>
            <a href="?link=exhibition"><li>exhibition</li></a>
            <a href="?link=festivals"><li>festivals</li></a>
            <a href="?link=fundraising"><li>fundraising</li></a>
            <a href="?link=sporting"><li>sports</li></a>
          </ul>
        </li></a>
        <a href="contacts"><li>contacts</li></a>
        <a href="index.php"><li class="dropdown">SUPPLIERS
          <ul>
            <a href="https://www.pigiame.co.ke/chairs-tables-for-hire/tents-tables-and-chairs-for-hire-1108815?utm_source=the-star.co.ke" target="_blank"><li>tents</li></a>
            <a href="https://www.pigiame.co.ke/chairs-tables-for-hire/tents-tables-and-chairs-for-hire-1108815?utm_source=the-star.co.ke" target="_blank"><li>chairs</li></a>
            <a href="https://www.pigiame.co.ke/djs-sound-systems-for-hire" target="_blank"><li>sound systems</li></a>
            <a href="http://www.limecatering.co.ke/for-hire.html" target="_blank"><li>catering</li></a>
          </ul>
        </li></a>
        <a href="orders"><li>orders</li></a>
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
          <br><br><br><br><br><br><br><br>
        </div>
        <div class="slider">
        <marquee><p><?php getMarquee(); ?></p></marquee>
        </div>
      </div>
    </div>
  </body>
</html>
