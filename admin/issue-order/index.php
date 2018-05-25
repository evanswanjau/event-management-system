<?php
require_once '../../engine/infused_cogs.php';
endSession($path='../../');
adminSecurity($path='../../');

if (isset($_GET['name']) && $_GET['name'] != '' && isset($_GET['phone']) && $_GET['phone'] != '') {
  $name = $_GET['name'];
  $phone = $_GET['phone'];
}else {
  header('location: ../messages');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <style media="screen">
      table{
        width:50%;
      }

      td{
        background-color:#999;
      }
    </style>
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../../"><li>home</li></a>
            <a href="../"><li class="current">messages</li></a>
            <a href="../orders"><li>orders</li></a>
            <a href="../inventory"><li>inventory</li></a>
            <a href="../"><li>events</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side container-form">
          <h3>Make Order</h3>
          <form class="ui-form" action="" method="post">
            <?php makeOrder(); ?>
            <input type="text" name="name" placeholder="full name" value="<?php if (empty($name)){ $name=null;}else {echo $name; } ?>"><br><br>
            <input type="text" name="phone" placeholder="number" value="<?php if (empty($phone)){ $phone=null;}else {echo $phone; } ?>"><br><br>
            <table>
              <tr>
                <th>item</th>
                <th>pick</th>
                <th>number of items</th>
              </tr>
              <?php displayOrders(); ?>
            </table><br><br>
            <p>event date</p>
            <input type="date" name="date"><br><br>
            <input type="submit" name="make-order" value="make order">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
