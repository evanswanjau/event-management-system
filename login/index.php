<?php require_once '../engine/infused_cogs.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <style media="screen">
      .container-form{
        padding:5%!important; 
      }
    </style>
  </head>
  <body style="background-color:#dfdfdf;">
    <div class="container-form">
      <form class="ui-form" action="" method="post">
        <h1>Login</h1>
        <?php loginUser(); ?>
        <input type="text" name="username" placeholder="username"><br><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="submit" name="login" value="login"><br><br>
        Don't have an account?<a href="../register"> Register</a>
      </form>
    </div>
  </body>
</html>
