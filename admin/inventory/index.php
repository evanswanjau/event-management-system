<?php
require_once '../../engine/infused_cogs.php';
endSession($path='../../');
adminSecurity($path='../../');

if (isset($_GET['edit']) && $_GET['edit'] != '') {

  $id = $_GET['edit'];

  $sql = "SELECT * FROM inventory WHERE item_id = $id";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $id = $row['item_id'];
    $item = $row['item'];
    $count = $row['count'];
    $price = $row['single_item_price'];
    }

    $value = '<input type="submit" name="edit-item" value="edit item">';
}else {
  $id = null;
  $value = '<input type="submit" name="add-item" value="add item">';
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../../"><li>home</li></a>
            <a href="../"><li>messages</li></a>
            <a href="../orders"><li>orders</li></a>
            <a href="../inventory"><li class="current">inventory</li></a>
            <a href="../events"><li>events</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side container-form">
          <h3>Inventory</h3>
          <br><br>
          <form class="ui-form" action="" method="post">
            <?php addNewItem(); editItem($id); deleteItem();?>
            <h2>Add new Item</h2>
            <input type="text" name="item" placeholder="item" value="<?php if (empty($item)){ $item=null;}else {echo $item; } ?>"><br><br>
            <input type="text" name="count" placeholder="count" value="<?php if (empty($count)){ $count=null;}else {echo $count; } ?>"><br><br>
            <input type="text" name="price" placeholder="price per item" value="<?php if (empty($price)){ $price=null;}else {echo $price; } ?>"><br><br>
            <?php echo $value; ?>
          </form>
          <br><br>
          <h1 style="text-align:center;">Inventory</h1>
          <table>
            <tr>
              <th>#</th>
              <th>item</th>
              <th>count</th>
              <th>price per item</th>
              <th>edit</th>
              <th>delete</th>
            </tr>
            <?php getInventory(); ?>
          </table>
          <br><br><br>
        </div>
      </div>
    </div>
  </body>
</html>
