<?php

# function clean our data
function clean_input($data) {
  $data = str_replace("'", "`", $data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


# function to get current date
function getCurrentDate(){
  date_default_timezone_set('Africa/Nairobi');
  $date = date('Y-m-d H:i:s');

  return $date;
}


# funtion to shuffle string
function stringShuffle($divide = 4){
  $string = 'abcdefghijklmnopqrst0123456789';

  $string = str_shuffle($string);

  $code = substr($string, 0, strlen($string)/$divide);

  return $code;
}

# upload event function
function uploadEvent(){

  global $conn;

  $date = getCurrentDate();
  $username = 'evanswanjau';

  if (isset($_POST['post-event'])) {
    $errors = array();

    # confirm name is not empty
    if ($_POST['name'] == '') {
      $errors[] = "<p class='error'>You haven't entered the event name</p>";
    }else {
      $name = clean_input($_POST['name']);
    }

    # confirm description is not empty
    if ($_POST['description'] == '') {
      $errors[] = "<p class='error'>You haven't entered a description</p>";
    }else {
      $description = clean_input($_POST['description']);
    }

    $event = $_POST['event'];

    # confirm message is not empty
    if ($_POST['venue'] == '') {
      $errors[] = "<p class='error'>You haven't entered a venue</p>";
    }else {
      $venue= clean_input($_POST['venue']);
    }

    $code = stringShuffle();

    if ($errors == []) {
      $sql = "INSERT INTO events (code, name, description, event, timestamp, postedby) VALUES('$code', '$name', '$description', ' $event', '$date', '$username')";

      if ($conn->query($sql) === TRUE){
        echo "<p class='success'>Event post successful</p>";
        header('refresh:2; url=../../');
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }else {
      foreach ($errors as $error) {
        echo $error;
      }
    }
  }
}

 ?>
