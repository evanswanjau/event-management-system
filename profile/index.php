<?php require_once '../engine/infused_cogs.php'; endSession($path='../'); userSecurity($path='../');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../"><li>home</li></a>
            <a href=""><li class="current">my events</li></a>
            <a href="new-event"><li>add new event</li></a>
            <a href="ticket"><li>tickets</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side">
          <?php
          if (isset($_GET['deleteevent'])) {
            $code = $_GET['deleteevent'];

            deleteEvent($code);
          }

          getMyEvents();

          ?>
        </div>
      </div>
    </div>
  </body>
</html>
