<?php require_once '../engine/infused_cogs.php'; endSession($path='../'); superAdminSecurity($path='../');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 side-menu">
          <ul>
            <a href="../"><li>home</li></a>
            <a href=""><li class="current">staff</li></a>
            <a href="?logout"><li>logout</li></a>
          </ul>
        </div>
        <div class="col-sm-9 other-side container-form">
          <h3>Create Staff Account</h3>
          <form class="ui-form" action="" method="post">
            <?php addStaffAccount(); deleteAdmin();?>
            <input type="text" name="name" placeholder="full name"><br><br>
            <input type="text" name="username" placeholder="username"><br><br>
            <input type="password" name="password" placeholder="password"><br><br>
            <input type="password" name="password2" placeholder="confirm password"><br><br>
            <input type="submit" name="add-admin" value="add admin"><br><br>
          </form>
          <h2 style="text-align:center;">Staff Members</h2><br>
          <table>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Username</th>
              <td>Delete</td>
            </tr>
            <?php getAdministrators(); ?>
          </table>

        </div>
      </div>
    </div>
  </body>
</html>
