<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>About</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  </head>
  <body>

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
        <a href="../contacts"><li>contacts</li></a>
        <?php profileLink('../'); ?>
      </ul>
    </div>

    <div class="container-fluid container-form">
      <div class="row">
        <div class="col-sm-6 paragraph">
          <h2>ABOUT</h2>

          <p>
            Event Planning and Management system is an alternative for event management companies or individuals who wish to use a web-based system.
            It will help to organize and plan conference, meeting, celebration, party, workshop, seminar, business activities, and other events.
          </p>
          <p>
            The main objective of the system will be to build the activity platform for event planning based on procedure which has been decided for use
            by event manager or event planner and interested individual. At this moment, many event management activities are carried out manually.
            By using this system event manager can increase their service support through the internet with at an affordable price.
          </p>

          <p>
            This system will also help in handling client requests more efficiently and effectively by generating full report.
            The system will be developed using the development model Unified Modelling Language (UML), the language Pretext Hyper Processor (PHP)
            and MySQL database. Other software’s to be used in developing the project include Microsoft Dreamweaver and Adobe Illustrator.
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
