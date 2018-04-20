<?php require_once '../../engine/infused_cogs.php'; endSession($path='../../'); userSecurity($path='../../');
    if (isset($_GET['editevent'])) {
      $code = $_GET['editevent'];

      $sql = "SELECT * FROM events WHERE code = '$code'";
      $result = $conn->query($sql);

      # get fields into variables
      while($row = $result->fetch_assoc()){
        $name = $row['name'];
        $description = $row['description'];
        $event = $row['event'];
        $event_date = $row['eventdate'];
        $entry_fee = $row['entryfee'];
        $venue = $row['venue'];
    }

  }else {
    $code = null;
  }

?>
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
    <style media="screen">
      .ui-form input, textarea, select{
        width:40%!important;
      }
    </style>
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../../"><li>home</li></a>
            <a href="../"><li>my events</li></a>
            <a href=""><li class="current">add new event</li></a>
            <a href="../ticket"><li>tickets</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 container-form" style="padding:1%">
          <form class="ui-form" action="" method="post">
            <h3>upload new event</h3>
            <?php uploadEvent(); editEvent($code);?>
            <input type="text" name="name" placeholder="event name" value="<?php if (empty($name)){ $name=null;}else {echo $name; } ?>"><br><br>
            <textarea name="description" rows="5" cols="80" placeholder="Enter a small description"><?php if (empty($description)){ $description=null;}else {echo $description; } ?></textarea><br><br>
            <select class="" name="event">
              <option value="<?php if (empty($event)){ $event=null;}else {echo $event; } ?>"><?php if (empty($event)){ echo "choose event";}else {echo $event; } ?></option>
              <option value="artsnculture">Arts and Culture</option>
              <option value="exhibition">Exhibition</option>
              <option value="festivals">Festivals</option>
              <option value="fundraising">Fundraising</option>
              <option value="sporting">Sporting</option>
            </select><br><br>
            <input type="text" name="entry-fee" placeholder="entry-fee" value="<?php if (empty($entry_fee)){ $entry_fee=null;}else {echo $entry_fee; } ?>"><br><br>
            <input type="date" name="event-date" value="<?php if (empty($event_date)){ $event_date=null;}else {echo $event_date; } ?>"><br><br>
            <input type="text" name="venue" placeholder="venue" value="<?php if (empty($venue)){ $venue=null;}else {echo $venue; } ?>"><br><br>
            <?php echo echoButton(); ?>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
