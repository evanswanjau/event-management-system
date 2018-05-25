<?php require_once '../../engine/infused_cogs.php'; endSession($path='../../'); adminSecurity($path='../../');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  </head>
  <body style="background-color:#dfdfdf;">

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../../"><li>home</li></a>
            <a href="../"><li>messages</li></a>
            <a href="../orders"><li class="current">orders</li></a>
            <a href="../inventory"><li>inventory</li></a>
            <a href="../events"><li>events</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side container-form">
          <h3>Orders</h3>
          <?php getOrders(); ?>
        </div>
      </div>
    </div>
  </body>
</html>
