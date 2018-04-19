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

#function that adds s to the end.
function addS($time){
  if ($time != 1) {
    $s = 's';
  }else {
    $s = '';
  }

  return $s;
}

#difference in time
function timeSpan($date){

  date_default_timezone_set('Africa/Nairobi');
  $current_date = date('Y-m-d');

  $seconds  = strtotime($date) - strtotime(date($current_date));

    $months = floor($seconds / (3600*24*30));
    $day = floor($seconds / (3600*24));
    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - ($hours*3600)) / 60);
    $secs = floor($seconds % 60);

    if($seconds < 60)
        $time = $secs." second".addS($secs)." to go";
    else if($seconds < 60*60 )
        $time = $mins." min".addS($mins)." to go";
    else if($seconds < 24*60*60)
        $time = $hours." hour".addS($hours)." to go";
    else if($seconds < 30*24*60*60)
        $time = $day." day".addS($day)." to go";
    else
        $time = $months." month".addS($months)." to go";

    return $time;
}

/*
--------------------------------------------
  events functionality
--------------------------------------------
*/
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
    if ($_POST['event-date'] == '') {
      $errors[] = "<p class='error'>You haven't entered the date</p>";
    }else {
      $event_date = clean_input($_POST['event-date']);
    }

    # confirm message is not empty
    if ($_POST['entry-fee'] == '') {
      $entry_fee = 'Free Entry';
    }else {
      $entry_fee = clean_input($_POST['entry-fee']);
    }

    # confirm message is not empty
    if ($_POST['venue'] == '') {
      $errors[] = "<p class='error'>You haven't entered a venue</p>";
    }else {
      $venue= clean_input($_POST['venue']);
    }

    $code = stringShuffle();

    if ($errors == []) {
      $sql = "INSERT INTO events (code, name, description, event, eventdate, entryfee, venue, timestamp, postedby) VALUES('$code', '$name', '$description', '$event', '$event_date', '$entry_fee', '$venue', '$date', '$username')";

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


# get events function
function getEvents(){

  global $conn;

  if (isset($_GET['link']) && $_GET['link'] != '') {
    $link = strtolower($_GET['link']);

    $sql = "SELECT * FROM events WHERE event = '$link' ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];

      echo "
      <div class='event'>
        <a href='?link=$event' class='kando'>#$event</a>
        <h3>$name</h3>
        <p style='padding:1% 0%'>$description</p>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date  <span class='kando' style='background-color:#34ca66;'>".timeSpan($event_date)."</span></p>
      </div>";
    }
  }else {
    $sql = "SELECT * FROM events ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];

      echo "
      <div class='event'>
        <a href='?link=$event' class='kando'>#$event</a>
        <h3>$name</h3>
        <p style='padding:1% 0%'>$description</p>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date  <span class='kando' style='background-color:#34ca66;'>".timeSpan($event_date)."</span></p>
      </div>";
    }
  }
}


# function to login the user
function loginUser(){
  if (isset($_POST['login'])) {
    global $conn;

    $errors = array(); #initialize array to store our errors

    #username
    if($_POST['username'] != ''){
      $username = clean_input($_POST['username']);
    }else {
      $errors[] = "<p class='error'>username is required</p>";
    }

    #password
    if($_POST['password'] != ''){
      $password = (clean_input($_POST['password']));
    }else {
      $errors[] = "<p class='error'>password is required</p>";
    }

    if($errors == []){
      $query = "SELECT username, password FROM users WHERE username = '$username'";
      $result = $conn->query($query);

      if($result->num_rows == 1){
        while($row = $result->fetch_assoc()) {
              $username = $row['username'];
              $hash = $row['password'];
            }

            if (password_verify($password, $hash)) {

              $_SESSION['user'] = $username;

              if ($username == 'admin') {
                header('Location: ../admin');
              }else {
                header('Location: ../profile');
              }

            } else {
              echo '<p class="error">Invalid login details</p>';
            }
      }else if($result->num_rows < 1){
        echo '<p class="error">That username does not exist</p>';
      }
    }else{
      foreach ($errors as $error) {
        echo $error;
      }
    }
  }
}

  # register user function
  function registerUser(){

    global $conn;

    $current_date = getCurrentDate();

    if (isset($_POST['register'])) {
      $errors = array(); #initialize array to store our errors

      # username
      if($_POST['name'] != ''){
        $name = clean_input($_POST['name']);
      }else {
        $errors[] = "<p class='error'>Full name is required</p>";
      }

      # username
      if($_POST['username'] != ''){
        $username = clean_input($_POST['username']);
      }else {
        $errors[] = "<p class='error'>username is required</p>";
      }

      #password
      if($_POST['password'] != ''){
        $password = clean_input($_POST['password']);

        if (strlen($password) < 6) {
          $errors[] = "<p class='error'>password cannot be less than 6 characters</p>";
        }else {

          # confirm password
          if($_POST['password2'] != ''){
            $password2 = clean_input($_POST['password2']);
          }else {
            $errors[] = "<p class='error'>Please confirm your password</p>";
          }

          if ($password == $password2) {
            $password = password_hash($password, PASSWORD_BCRYPT);
          }else {
            $errors[] = "<p class='error'>Passwords are not similar</p>";
          }

        }
      }else {
        $errors[] = "<p class='error'>password is required</p>";
      }


      # when no errors exist
      if($errors == []){

        $sql = "SELECT username FROM users where username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<p class='error'>That account already exists</p>";
        }else {

          #Inserting the user's data into our database
          $sql = "INSERT INTO users ( name, username, password, dor)
          VALUES ('$name', '$username', '$password', '$current_date')";

          if ($conn->query($sql) === TRUE) {

            $_SESSION['user'] = $username;
            echo "<p class='success'>Registration successful</p>";
            header('refresh:2; url=../');

          }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

      }else {
        foreach ($errors as $error) {
          echo $error;
        }
      }
    }
  }

 ?>
