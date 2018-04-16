<?php require_once '../../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload new event</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.min.css">
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.min.css">
    <script src="../../js/jquery-ui.min.js"></script>
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-form">
      <form class="ui-form" action="" method="post">
        <h1>upload new event</h1>
        <?php uploadEvent(); ?>
        <input type="text" name="name" placeholder="event name"><br><br>
        <textarea name="description" rows="4" cols="80" placeholder="Enter a small description"></textarea><br><br>
        <select class="" name="event">
          <option value="Weddings">weddings</option>
          <option value="Sports">sports</option>
          <option value="Art">art</option>
        </select><br><br>
        <input type="text" name="venue" placeholder="venue"><br><br>
        <input type="submit" name="post-event" value="post event">
      </form>
    </div>
  </body>
</html>
