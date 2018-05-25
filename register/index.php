<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-form">
      <form class="ui-form" action="" method="post">
        <h1>Register</h1>
        <?php registerUser(); ?>
        <input type="text" name="name" placeholder="full name"><br><br>
        <input type="text" name="username" placeholder="username"><br><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="password" name="password2" placeholder="confirm password"><br><br>
        <input type="submit" name="register" value="register"><br><br>
        Already have an account?<a href="../login"> login</a>
      </form>
    </div>
  </body>
</html>
