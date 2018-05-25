<?php require_once '../../engine/infused_cogs.php'; endSession($path='../../'); userSecurity($path='../../');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ticket</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../../"><li>home</li></a>
            <a href="../"><li>my events</li></a>
            <a href="../new-event"><li>add new event</li></a>
            <a href=""><li class="current">tickets</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side" >
          <?php

          if (isset($_GET['deleteticket'])) {
            $ticket = $_GET['deleteticket'];
            deleteTicket($ticket);
          }

          if (isset($_GET['ticket_number']) && $_GET['ticket_number'] != '') {
            $code = $_GET['ticket_number'];
            getTicket($code);
          }else {
            getTickets();
          }

           ?>
        </div>
      </div>
    </div>
  </body>
</html>
