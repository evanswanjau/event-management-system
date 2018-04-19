<?php require_once '/engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EMS</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery-ui.min.js"></script>
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 side-menu">
          <div class="row">
            <a href="?link=">
              <div class="col-sm-5 menu">
                <h3>All Events</h3>
              </div>
            </a>
            <a href="?link=artsnculture">
              <div class="col-sm-5 menu">
                <h3>Arts and Culture</h3>
              </div>
            </a>
            <a href="?link=exhibition">
              <div class="col-sm-5 menu">
                <h3>Exhibition</h3>
              </div>
            </a>
            <a href="?link=festivals">
              <div class="col-sm-5 menu">
                <h3>Festivals</h3>
              </div>
            </a>
            <a href="?link=fundraising">
              <div class="col-sm-5 menu">
                <h3>Fundraising</h3>
              </div>
            </a>
            <a href="?link=sports">
              <div class="col-sm-5 menu">
                <h3>Sports</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="col-sm-8 event-container">
          <?php getEvents(); ?>
        </div>
      </div>
    </div>
  </body>
</html>
